<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;

trait BaseController
{
    public $secret="FLWSECK-a69efe1a1b4af5d37673a67088b1693e-X";
    public $public="FLWPUBK-2bd9bd3d2f1e0250715973e476561a47-X";
    public $currency="NGN";
    public $url='https://foodxyme.com/';
    public $soupCategory=3;
    public $mainMealCategory=1;
    public $soupProteins=11;


    public function audit($task,$user_id){

        $data_audit=array(
            'user_id'=>$user_id,
            'task'=>$task,
        );

        DB::table('audit_trails')->insert($data_audit);
    }

    public function user(){

        if(Auth::check()){

            $user=Auth::user();

            if($user->role_id==1){
                $userDetails=DB::table('customers')->where('user_id',$user->id)->first();
            }
            elseif($user->role_id==2){
                $userDetails=DB::table('vendors')->where('user_id',$user->id)->first();
            }
            elseif($user->role_id==3){
                $userDetails=DB::table('bikemen')->where('user_id',$user->id)->first();
            }
            return $userDetails;

        }


    }

    public function cartAmount()
    {
        $cart = session()->get('cart');
        $total=0;
        if($cart){

            foreach($cart as $id=>$detail){
                $amount=$detail['price']*$detail['quantity'];
                $total=$amount+$total;
            }

        }
        session()->put('cartAmount',$total);
        return $total;

    }


    public function flutterwave($email,$amount,$ref,$redirect_url)
    {


        $currency =$this->currency;
        $txref = $ref; // ensure you generate unique references per transaction.
        $PBFPubKey = $this->public; // get your public key from the dashboard.FLWPUBK-9982b10d6e06736ec658f580293dad17-X

        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_POSTFIELDS => json_encode([
            'amount'=>$amount,
            'customer_email'=>$email,
            'currency'=>$currency,
            'txref'=>$txref,
            'PBFPubKey'=>$PBFPubKey,
            'redirect_url'=>$redirect_url,

            ]),
            CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
        }

        $transaction = json_decode($response);

        return $transaction;

        

    }

    public function userPayment($email,$amount,$ref,$redirect_url)
    {

        $transaction=$this->flutterwave($email,$amount,$ref,$redirect_url);
        if(!$transaction->data && !$transaction->data->link){

            return redirect()->back()->with('error',$transaction->message);
        }

        return redirect($transaction->data->link);

    }

    public function flutterwaveVerify($amount,$ref)
    {
       
        $query = array(

            "SECKEY" => $this->secret,
            "txref" => $ref
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYPEER=>false,
        CURLOPT_POSTFIELDS => json_encode($query),
        CURLOPT_HTTPHEADER => [
        "content-type: application/json",
        "cache-control: no-cache"
        ],
        ));


        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];
        $data=array(
            'paymentStatus'=>$paymentStatus,
            'chargeResponsecode'=>$chargeResponsecode,
            'chargeAmount'=>$chargeAmount,
            'chargeCurrency'=>$chargeCurrency,
            
        );

        if (($data['chargeResponsecode'] == "00" || $data['chargeResponsecode'] == "0") && ($data['chargeAmount'] == $amount)  && ($data['chargeCurrency'] == $this->currency)) {
           return true;
        }

        else {
            return false;
        }
        

    }


    public function VendorMoney()
    {
        $vendor_id = $this->user()->idvendors;
        $user_id =Auth::user()->id;

        $vendor = DB::table('ordersummaries')->where('vendor_id',$vendor_id)->where('status',3)->get();
        $amount = 0;
        $withdraw=0;
        foreach($vendor as $v){
            $amount = $amount + $v->vendor_fee;
        }
        $vendorwithdraw = DB::table('withdrawals')->where('user_id',$user_id)->get();
        foreach($vendorwithdraw as $j){
            $withdraw = $withdraw + $j->amount;
        }
        $credit =$amount -$withdraw;
        return $credit;

    }

    public function walletMoney()
    {
        $user_id = Auth::user()->id;
        $credits= DB::table('credits')->where('user_id',$user_id)->get();
        $withdrawals = DB::table('withdrawals')->where('user_id',$user_id)->get();

        $amount=0;
        $withdraw=0;
        foreach($credits as $credit)
        {
            $amount=$amount+$credit->amount;
        }
        foreach($withdrawals as $withdrawal)
        {
            $withdraw =$withdraw+$withdrawal->amount;
        }

        $credit=$amount-$withdraw;

        return $credit;
    }

    public function vendorClose($id){

        $vendor=DB::table('vendors')->where('idvendors',$id)->first();

        $close = true;
        $now= time()+3600; 
        $time=(int)date('H',$now);
        if($time>=(int)$vendor->open_at and $time<=(int)$vendor->close_at){
            $close= false;
        }

        if($vendor->close_status==1){
            $close=true;
            
            
        }

        return $close;
    }


  
}
