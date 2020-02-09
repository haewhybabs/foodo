<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NewOrder;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('secure');

    }
    public function index()
    {
        $vendor_id=$this->user()->idvendors;
        $stock_category=DB::table('stockcategories')->where('vendor_id',$vendor_id)->get();
        $user=$this->user();

        $credits = DB::table('ordersummaries')->join('transactions','transactions.order_summaries_id','=','ordersummaries.idordersummaries')
        ->select('ordersummaries.*','transactions.reference')
        ->where('ordersummaries.vendor_id',$vendor_id)->where('ordersummaries.status',3)->get();


        $getTransaction=DB::table('transactions')
        ->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
        ->join('users','users.id','=','ordersummaries.user_id')
        ->where('ordersummaries.vendor_id',$vendor_id)->where('transactions.status',1)
        ->select('ordersummaries.*','transactions.reference','users.*')
        ->orderBy('ordersummaries.idordersummaries','desc')->get();

        $bankcodes = DB::table('bankcodes')->get();

        $bankDetails = DB::table('bankdetails')
        ->join('bankcodes','bankcodes.bank_codes','=','bankdetails.bank_code')
        ->where('vendor_id',$vendor_id)->first();





        $data=array(

            'stockcategories'=>$stock_category,
            'user'=>$user,
            'transactions'=>$getTransaction,
            'vendorMoney'=>$this->VendorMoney(),
            'credits'=>$credits,
            'bankcodes'=>$bankcodes,
            'bankdetails'=>$bankDetails,
        );
        return view('web.vendor.vendorspage')->with($data);

    }

    public function stockCategory(Request $request)
    {

        if($request->category_name[0]==null){

            return redirect('vendor-account')->with('error','Stock categories is required');

        }


        for($i=0; $i<count($request->category_name); $i++){

            $data=array(
                'name'=>$request->category_name[$i],
                'vendor_id'=>$this->user()->idvendors,
            );
            DB::table('stockcategories')->insert($data);
        }

        return redirect('vendor-account')->with('message','Stock categories created successfully');


    }

    public function stockCreate(Request $request)
    {
        $stockData= $request->validate([

            'stockcategory'=>'required',
        ]);

        if($request->stock_name[0]==null || $request->stock_price[0]==null){

            return redirect('vendor-account')->with('error','All the fields are required');

        }


        for($i=0; $i<count($request->stock_name); $i++){

            $data=array(
                'name'=>$request->stock_name[$i],
                'stock_category_id'=>$request->stockcategory,
                'stockprice'=>$request->stock_price[$i],
                'vendor_id'=>$this->user()->idvendors,
                'status'=>'Available'
            );
            DB::table('stockdetails')->insert($data);
        }

        return redirect('vendor-account')->with('message','Stock added successfully');
    }

    public function stockStatus($id,$status){

        if($status=='available'){
            DB::table('stockdetails')->where('idstockdetails',$id)->update(['status'=>'Available']);
        }

        elseif($status=='finish'){

            DB::table('stockdetails')->where('idstockdetails',$id)->update(['status'=>'Finished']);
        }

        return redirect('vendor-account')->with('message','Stock updated successfully');

    }

    public function vendorDelivery($id){

        DB::table('ordersummaries')->where('idordersummaries',$id)->update(['status'=>2]);
        return redirect('vendor-account')->with('message','Food successfully set on delivery');
    }

    public function transferAccountUpdate(Request $request)
    {
        $vendor_id=$this->user()->idvendors;

        $validate = $request->validate([

            'account_number'=>'required',
            'bank_code'=>'required',
            'beneficiary_name'=>'required',
        ]);

        $validate['vendor_id'] =$vendor_id;

        $transferDetails = DB::table('bankdetails')->where('vendor_id',$vendor_id)->first();

        if($transferDetails){
            DB::table('bankdetails')->where('vendor_id',$vendor_id)->update($validate);
        }
        else{
            DB::table('bankdetails')->insert($validate);
        }

        return redirect('vendor-account')->with('message','Acount Updated Successfully');
    }

    public function payout(Request $request){

        $validate = $request->validate([
            'amount'=>'required'
        ]);

        $amount = $request->amount;
        if($amount > $this->vendorMoney()){
            return redirect('vendor-account')->with('error','Kindly Check the input Amount!!!');
        }

        $vendor_id = $this->user()->idvendors;

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length=16;
        $reference=substr(str_shuffle(str_repeat($pool, 5)), 0, $length).'_PMCK';

        $bankdetails =DB::table('bankdetails')->where('vendor_id',$vendor_id)->first();
        if(!$bankdetails){
            return redirect('vendor-account')->with('error','Kindly update your bank details');
        }

        $data = array(
            'account_bank'=>$bankdetails->bank_code,
            'account_number' =>$bankdetails->account_number,
            'reference'=>$reference,
            'currency'=>'NGN',
            'narration'=>'Foodxyme Payment',
            'beneficiary_name'=>$bankdetails->beneficiary_name,
            'seckey'=>"FLWSECK_TEST-13ca0b1d665990d2efadb818a6ffbc8b-X",
            'amount'=>$amount,

        );
        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/v2/gpx/transfers/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){

            die('Curl returned error: ' . $err);
        }
        $output=json_decode($response);

        $userwithdraw=array(
            'user_id'=>Auth::user()->id,
            'amount'=>$amount,
            'reference'=>$reference,
        );
        if($output->status =='success'){

            DB::table('withdrawals')->insert($userwithdraw);

            return redirect('vendor-account')->with('message','Your withdraw request was successful!!! You will be credited soon.');

        }


        return redirect('vendor-account')->with('error','oopss!! Your request is unsuccessful!!');




    }
}
