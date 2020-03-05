<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\BaseController;
use App\Events\NewOrder;

class CheckoutController extends Controller
{
    use BaseController;

    public function index(Request $request)
    {

        if(!session()->get('cart')){
            return redirect('/');
        }

        if(!Auth::check()){
                session()->put('CheckoutButNotUnthenticated',true);
                return redirect('login');
        }

        $vendor_id=session()->get('vendor_id');

        #Get Vendor Region
        $vendor=DB::table('vendors')->where('idvendors',$vendor_id)->first();
        $vendorRegion=$vendor->region_id;

        $close =$this->vendorClose($vendor->idvendors);
        if($close==true){

            return redirect()->back()->with('error','We have closed. Thank you');
        }

        

        #Get User Region
        $user_id=Auth::user()->id;
        $charges=0;
        $delivery_fee=0;
        $userAddress=DB::table('address')->where('user_id',Auth::user()->id)->where('active',1)->first();
        $regions = DB::table('regions')->get();
        $service_charge=0;
        

        if($userAddress)
        {
            #Service Charge
            $cartAmount=$this->cartAmount();

            $vendor_percentage = DB::table('vendorpercentage')->where('vendor_id',$vendor_id)->where('minAmount','<=',$cartAmount)
            ->where('maxAmount','>=',$cartAmount)->first();
            if($vendor_percentage){
                $percentage = ($vendor_percentage->percentage/100)*$cartAmount;
                $vendor_fee =$cartAmount-$percentage;
            }
            else{
                $general_setting = DB::table('general_settings')->where('minAmount','<=',$cartAmount)
                ->where('maxAmount','>=',$cartAmount)->first();
                if($general_setting){
                    $percentage = ($general_setting->service_charge/100) * $cartAmount;
                    $vendor_fee=$this->cartAmount();
                    $service_charge = $percentage;
                }
            }

            $chargesData=array(
                'vendor_fee'=>$vendor_fee,
                'service_charge'=>$service_charge,
            );

            session()->put('chargesData',$chargesData);

            

            $userRegion=$userAddress->region_id;

            $priceBreakDown=DB::table('pricebreakdowns')->where('from_region_id',$vendorRegion)->where('to_region_id',$userRegion)->first();


            if($priceBreakDown){
                $charges=$priceBreakDown->charges;
                $delivery_fee=$priceBreakDown->delivery_fee;

                $amount=array(
                    'service_charge'=>$service_charge,
                    'delivery_fee'=>$delivery_fee,
                    'total'=>$this->cartAmount()+$service_charge+$delivery_fee
                );
                
            }
            else{

                $amount=array(
                    'service_charge'=>$service_charge,
                    'delivery_fee'=>$charges,
                    'total'=>$this->cartAmount()+$service_charge+$delivery_fee
                );
                
            }
            session()->put('AmountToPay',$amount);
        }

       $address=DB::table('address')->join('regions','address.region_id','=','regions.idregions')
       ->where('address.user_id',Auth::user()->id)->get();

       $activeAddress=DB::table('address')->join('regions','address.region_id','=','regions.idregions')
       ->where('address.user_id',Auth::user()->id)->where('address.active','1')->first();

        $activeStatus=0;
        if($activeAddress){
            $activeStatus=1;
        }

       $cities=DB::table('cities')->get();

       
       


       $data=array(
           'cities'=>$cities,
           'activeAddress'=>$activeAddress,
           'address'=>$address,
           'activeStatus'=>$activeStatus,
           'charges'=>$charges,
           'service_charge'=>$service_charge,
           'delivery_fee'=>$delivery_fee,
           'regions'=>$regions,
       );

       return view('web.checkout')->with($data);
    }

    public function addAddress(Request $request)
    {
        $validatedData= $request->validate([

            'region_id'=>'required',
            'complete_address'=>'required',
            'city_id'=>'required',
        ]);
        $city_id=$request->city_id;

        $region_id=$request->region_id;
        

        #Check if the address is not greater than 3
        $address=DB::table('address')->where('user_id',Auth::user()->id)->get();
        if(count($address)>2){
            return redirect('checkout')->with(['alert-type'=>'error','message'=>'Sorry!! Your Address cannot be greater than 3']);
        }

        $addressData=array(
            'region_id'=>$region_id,
            'complete_address'=>$request->complete_address,
            'delivery_instruction'=>$request->delivery_instruction,
            'user_id'=>Auth::user()->id,
            'phone_number'=>$request->phone_number,
            'active'=>0,
        );
        DB::table('address')->insert($addressData);
        $data=array(
            'message'=>'Your address is successfully saved',
            'alert-type'=>'info',
        );
        return redirect('checkout')->with($data);

    }

    public function deliverHere($id)
    {
        DB::table('address')->where('user_id',Auth::user()->id)->update(['active'=>0]);
        DB::table('address')->where('idaddress',$id)->update(['active'=>1]);

       
        

        $data=array(

            'message'=>'Delivery address selected',
            'alert-type'=>'info',
        );

        return redirect('checkout')->with($data);
    }

    public function removeAddress($id)
    {
        DB::table('address')->where('idaddress',$id)->delete();
       $data=array(
            
            'message'=>'Delivery address removed',
            'alert-type'=>'info',
        );
        return redirect('checkout')->with($data);
    }

    public function changeAddress($id)
    {
        DB::table('address')->where('user_id',Auth::user()->id)->update(['active'=>0]);
        $data=array(
            
            'message'=>'okay!! select a new address',
            'alert-type'=>'info',
        );
        return redirect('checkout')->with($data);
    }

    public function transaction(Request $request){

        $amount=session()->get('AmountToPay')['total'];

        #Validation
        if($request->wallet==1){
            if($this->walletMoney()<$amount){
                
                $reply=array(
            
                    'message'=>'Insufficient Balance!!!! Kindly Recharge your balance',
                    'alert-type'=>'error',
                );
                return redirect('checkout')->with($reply);
            }
        }

        $user_id=Auth::user()->id;
        $address=DB::table('address')->where('user_id',$user_id)->where('active',1)->first();
        if(!$address){
            
            $reply=array(
            
                'message'=>'Please tell us your address',
                'alert-type'=>'error',
            );
            return redirect('checkout')->with($reply);
        }

        if(session()->get('AmountToPay')['delivery_fee']==0){

            $reply=array(
            
                'message'=>'Sorry!! We could not locate your Area, You could check up later or Enter a popular area',
                'alert-type'=>'error',
            );
            return redirect('checkout')->with($reply);
        }

        #Insertion

        $vendor_id=session()->get('vendor_id');

        #Get Vendor Region
        $vendor=DB::table('vendors')->where('idvendors',$vendor_id)->first();
        $vendorRegion=$vendor->region_id;

        #Get User Region
        $user_id=Auth::user()->id;
        $userAddress=DB::table('address')->where('user_id',Auth::user()->id)->where('active',1)->first();
        $userRegion=$userAddress->region_id;

        $cartAmount=$this->cartAmount();

        $chargesData = session()->get('chargesData');

        $orderSummaryData=array(
            'vendor_id'=>$vendor_id,
            'user_id'=>$user_id,
            'from_region_id'=>$userRegion,
            'to_region_id'=>$vendorRegion,
            'status'=>0,
            'total_amount'=>session()->get('AmountToPay')['total'],
            'vendor_fee'=>$chargesData['vendor_fee'],
            'service_charge'=>$chargesData['service_charge']
        );

        

        #insert to Order Summary
        $orderSummary=DB::table('ordersummaries')->insertGetId($orderSummaryData);

        #Delivery Address

        $deliveryAddress = DB::table('address')->where('user_id',Auth::user()->id)->where('active',1)->first();

        $deliveryData = array(

            'region_id'=>$deliveryAddress->region_id,
            'complete_address'=>$deliveryAddress->complete_address,
            'delivery_instruction'=>$deliveryAddress->delivery_instruction,
            'phone_number'=>$deliveryAddress->phone_number,
            'order_summary_id'=>$orderSummary,
        );

        DB::table('delivery_address')->insert($deliveryData);

        #Insert TO Order Details
        foreach(session()->get('cart') as $id=>$detail){
            $orderDetailData=array(
                'order_summaries_id'=>$orderSummary,
                'stock_details_id'=>$detail['stock_id'],
                'qty'=>$detail['quantity'],
                'price'=>$detail['price'],
            );
            $stock_detail_id = DB::table('orderdetails')->insertGetId($orderDetailData);

            if(count($detail['proteins']) !=0){
                
                #Insert Protein 
                foreach($detail['proteins'] as $protein)
                {
                    $proteinData=array(
                        'stock_id'=>$protein['id'],
                        'qty'=>$protein['qty'],
                        'price'=>$protein['price'],
                        'order_detail_id'=>$stock_detail_id
                    );

                    DB::table('orderprotein')->insert($proteinData);
                }
            }
        }

        #Insert To Transaction
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length=16;
        $reference=substr(str_shuffle(str_repeat($pool, 5)), 0, $length);

        $transactionData=array(
            'order_summaries_id'=>$orderSummary,
            'reference'=>$reference,
            'status'=>0,
        );
        DB::table('transactions')->insert($transactionData);

        $text=$request->text;

        // event(new NewOrder($text));

        $email=Auth::user()->email;
        $amount=session()->get('AmountToPay')['total'];
        $ref=$reference;
        $redirect_url= $this->url."payment-verification";

        
        if($request->wallet==1){

            if($this->walletMoney()>=$amount)
            {
                $withdrawal=array(
                    'user_id'=>Auth::user()->id,
                    'amount'=>$amount,
                    'reference'=>$ref,  
                );
                DB::table('withdrawals')->insert($withdrawal);

                #Wallet
                $wallet = array(
                    'amount'=>$this->walletMoney(),
                );
                $customer_id = $this->user()->idcustomers;
                DB::table('customers')->where('idcustomers',$customer_id)->update($wallet);

                #Transactions
                DB::table('transactions')->where('reference',$ref)->update(['status'=>1]);
                DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
                ->where('transactions.reference',$ref)->update(['ordersummaries.status'=>1]);

                $transaction=DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
                ->where('transactions.reference',$ref)->first();

                session()->forget('vendor_id');
                session()->forget('cart');
                session()->forget('cartAmount');
                session()->forget('AmountToPay');

                return redirect('thankyou/'.$ref);
            }
        }
        else
        {
            #Redirect TO FLutterwave Page
            return $this->userPayment($email,$amount,$ref,$redirect_url);
        }
        
        
    }

    public function paymentVerification()
    {
        $amount =session()->get('AmountToPay')['total'];

        if (isset($_GET['txref'])) {
            $ref=$_GET['txref'];

            if($this->flutterwaveVerify($amount,$ref)==true){

                DB::table('transactions')->where('reference',$ref)->update(['status'=>1]);
    
                DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
                ->where('transactions.reference',$ref)->update(['ordersummaries.status'=>1]);
                

                $transaction=DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
                ->where('transactions.reference',$ref)->first();

    
                session()->forget('vendor_id');
                session()->forget('cart');
                session()->forget('cartAmount');
                session()->forget('AmountToPay');
    
                return redirect('thankyou/'.$ref);
            }
    
            else {
                
                $reply=array(
            
                    'message'=>'Error ocurred!!!',
                    'alert-type'=>'error',
                );
                return redirect('checkout')->with($reply);
            }
        }
        else {
            die('No reference supplied');
        }

    }
}
