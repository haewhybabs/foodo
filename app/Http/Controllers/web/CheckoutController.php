<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\NewOrder;

class CheckoutController extends Controller
{

    public function index()
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

        $now= time()+3600; $time=(int)date('H',$now);
        if($time>=$vendor->open_at and $time<=$vendor->close_at+12){
        }
        else{
            return redirect()->back()->with('error','We have closed. Thank you');
        }
        #Get User Region
        $user_id=Auth::user()->id;
        $charges=0;
        $delivery_fee=0;
        $userAddress=DB::table('address')->where('user_id',Auth::user()->id)->where('active',1)->first();

        if($userAddress){
            $userRegion=$userAddress->region_id;

            $priceBreakDown=DB::table('pricebreakdowns')->where('from_region_id',$vendorRegion)->where('to_region_id',$userRegion)->first();


            if($priceBreakDown){
                $charges=$priceBreakDown->charges;
                $delivery_fee=$priceBreakDown->delivery_fee;

                $amount=array(
                    'charges'=>$charges,
                    'delivery_fee'=>$delivery_fee,
                    'total'=>session()->get('cartAmount')+$charges+$delivery_fee
                );
                session()->put('AmountToPay',$amount);
            }
            else{
                $amount=array(
                    'charges'=>0,
                    'delivery_fee'=>0,
                    'total'=>session()->get('cartAmount')+$charges+$delivery_fee
                );
                session()->put('AmountToPay',$amount);
            }
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
           'delivery_fee'=>$delivery_fee
       );

       return view('web.checkout')->with($data);
    }

    public function addAddress(Request $request)
    {
        $validatedData= $request->validate([

            'region'=>'required',
            'complete_address'=>'required',
            'city_id'=>'required',
        ]);
        $city_id=$request->city_id;

        $region=$request->region;
        $region_id=0;
        $checkregion=DB::table('regions')->where('name','like',$region.'%')->where('city_id',$city_id)->first();
        if($checkregion){

            $region_id=$checkregion->idregions;


        }
        else{
            $subregion=DB::table('subregions')->where('name','like',$region.'%')->first();
            if($subregion){
                $region_id=$subregion->region_id;
            }

        }
        if($region_id==0){
            return redirect('checkout')->with('error','Sorry!! We could not locate your Area, You could check up later or Enter a popular area');
        }

        #Check if the address is not greater than 3
        $address=DB::table('address')->where('user_id',Auth::user()->id)->get();
        if(count($address)>2){
            return redirect('checkout')->with('error','Sorry!! Your Address cannot be greater than 3');
        }

        $addressData=array(
            'region_id'=>$region_id,
            'complete_address'=>$request->complete_address,
            'delivery_instruction'=>$request->delivery_instruction,
            'user_id'=>Auth::user()->id,
            'active'=>0,
        );
        DB::table('address')->insert($addressData);
        return redirect('checkout')->with('message','Your address is successfully saved');

    }

    public function deliverHere($id)
    {
        DB::table('address')->where('user_id',Auth::user()->id)->update(['active'=>0]);
        DB::table('address')->where('idaddress',$id)->update(['active'=>1]);
        return redirect('checkout')->with('message','Delivery address selected');
    }

    public function removeAddress($id)
    {
        DB::table('address')->where('idaddress',$id)->delete();
        return redirect('checkout')->with('message','Delivery address removed');
    }

    public function changeAddress($id)
    {
        DB::table('address')->where('user_id',Auth::user()->id)->update(['active'=>0]);
        return redirect('checkout')->with('message','Okay!! Select a new Address');
    }

    public function transaction(Request $request){

        #Validation

        $user_id=Auth::user()->id;
        $address=DB::table('address')->where('user_id',$user_id)->where('active',1)->first();
        if(!$address){
            return redirect('checkout')->with('error','Please tell us your address!!!!');
        }

        if(session()->get('AmountToPay')['delivery_fee']==0 or session()->get('AmountToPay')['charges']==0){

            return redirect('checkout')->with('error','Sorry!! We could not locate your Area, You could check up later or Enter a popular area');
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

        $vendorAmount=session()->get('cartAmount');

        $vendor_percentage = DB::table('vendorpercentage')->where('vendor_id',$vendor_id)->where('minAmount','<=',$vendorAmount)
        ->where('maxAmount','>=',$vendorAmount)->first();
        $percentage = ($vendor_percentage->percentage/100)*$vendorAmount;

        $orderSummaryData=array(
            'vendor_id'=>$vendor_id,
            'user_id'=>$user_id,
            'from_region_id'=>$userRegion,
            'to_region_id'=>$vendorRegion,
            'status'=>0,
            'total_amount'=>session()->get('AmountToPay')['total'],
            'vendor_fee'=>session()->get('cartAmount')-$percentage,
        );

        #insert to Order Summary
        $orderSummary=DB::table('ordersummaries')->insertGetId($orderSummaryData);

        #Insert TO Order Details
        foreach(session()->get('cart') as $id=>$detail){
            $orderDetailData=array(
                'order_summaries_id'=>$orderSummary,
                'stock_details_id'=>$detail['stock_id'],
                'qty'=>$detail['quantity']
            );

            DB::table('orderdetails')->insert($orderDetailData);
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

        #Redirect TO FLutterwave Page
        $email=Auth::user()->email;
        $amount=session()->get('AmountToPay')['total'];
        $ref=$reference;
        return $this->flutterwave($email,$amount,$ref);
    }

    public function paymentVerification()
    {
        $amount =session()->get('AmountToPay')['total'];

        if (isset($_GET['txref'])) {
            $ref=$_GET['txref'];

            return $this->verify($amount,$ref);
        }
        else {
            die('No reference supplied');
        }


        // return $this->verify($amount);
    }
}
