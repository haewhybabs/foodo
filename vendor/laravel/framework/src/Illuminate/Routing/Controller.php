<?php

namespace Illuminate\Routing;

use BadMethodCallException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the controller.
     *
     * @param  \Closure|array|string  $middleware
     * @param  array  $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

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


    public function flutterwave($email,$amount,$ref)
    {


        $currency = "NGN";
        $txref = $ref; // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK_TEST-5406e801d01e00866fa150108da3d1f5-X"; // get your public key from the dashboard.FLWPUBK-9982b10d6e06736ec658f580293dad17-X
        $redirect_url = "http://127.0.0.1:8000/payment-verification";

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

        if(!$transaction->data && !$transaction->data->link){

            return redirect()->back()->with('error',$transaction->message);
        }

        return redirect($transaction->data->link);

    }

    public function verify($amount,$ref)
    {
        $currency = "NGN";

        $query = array(

            "SECKEY" => "FLWSECK_TEST-13ca0b1d665990d2efadb818a6ffbc8b-X",
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

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
            DB::table('transactions')->where('reference',$ref)->update(['status'=>1]);

            session()->forget('vendor_id');
            session()->forget('cart');
            session()->forget('cartAmount');
            session()->forget('AmountToPay');

            return redirect('thankyou/'.$ref);
        }

        else {
            return redirect('/')->with('error','Error ocurred !!!');
        }


    }

    public function VendorMoney()
    {
        $vendor_id = $this->user()->idvendors;

        $vendor = DB::table('ordersummaries')->where('vendor_id',$vendor_id)->where('status',3)->get();
        $amount = 0;
        foreach($vendor as $v){
            $amount = $amount + $v->vendor_fee;
        }
        return $amount;

    }
}
