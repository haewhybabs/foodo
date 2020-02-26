<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\BaseController;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    use BaseController;

    public function add(Request $request)
    {
        $id = $request->id;
        $amount =$this->cartAmount();


        $data = array(
            'status'=>false,
        );


        $stock=DB::table('stockdetails')->where('idstockdetails',$id)->first();

        $currentVendor=session()->get('vendor_id');
        if(!$currentVendor){

            $currentVendor=$stock->vendor_id;
        }

        if($stock->vendor_id!=$currentVendor){

            $data['message'] = 'Error!!! You have not checked out with the previous vendor';
            return response()->json($data);
        }

        if(!$stock){
            abort(404);
        }

        $vendor=DB::table('vendors')->where('idvendors',$currentVendor)->first();


        $now= time()+3600; $time=(int)date('H',$now);
        if($time>=$vendor->open_at and $time<=$vendor->close_at+12){
        }
        else{

            $data['message']='We have closed. Thank you';
            return response()->json($data);

        }

        $cart=session()->get('cart');

        if(!$cart){
            session()->put('vendor_id',$stock->vendor_id);

            $cart =
            [
                $id=>
                [
                    'stock_id'=>$stock->idstockdetails,
                    "vendor_id"=>$stock->vendor_id,
                    "name"=> $stock->name,
                    "quantity" => 1,
                    "price" => $stock->stockprice,
                    "proteins"=>[],
                    
                ]
            ];

            session()->put('cart',$cart);

            $amount =$this->cartAmount();
            $view = view("jquery.cartshow")->render();
            $data['html']=$view;
            $headercart=view("jquery.cart_header")->render();
            $data['headercart']=$headercart;
            $data['message']='Product added to cart';
            $data['alert-type']='info';
            $data['status']=true;
            return response()->json($data);


        }

        if(isset($cart[$id]))
        {

            $cart[$id]['quantity']++;

            session()->put('cart',$cart);
            $amount = $this->cartAmount();
            $view = view("jquery.cartshow")->render();
            $headercart=view("jquery.cart_header")->render();
            $data['headercart']=$headercart;
            $data['html']=$view;
            $data['message']='Product added to cart';
            $data['alert-type']='info';
            $data['status']=true;
            return response()->json($data);
        }


        $cart[$id] = [
            'stock_id'=>$stock->idstockdetails,
            "vendor_id"=>$stock->vendor_id,
            "name"=>$stock->name,
            "quantity"=>1,
            "price"=>$stock->stockprice,
            "proteins"=>[],
        ];
        
        session()->put('cart',$cart);
        $amount =$this->cartAmount();
        $view = view("jquery.cartshow")->render();
        $headercart=view("jquery.cart_header")->render();
        $data['headercart']=$headercart;
        $data['html']=$view;
        $data['message']='Product added to cart';
        $data['alert-type']='info';
        $data['status']=true;
        return response()->json($data);

    }

    public function proteinSoup(Request $request)
    {
        if(!$request->stock_protein){
            $reply=array(
                'alert-type'=>'error',
                'message'=>'kindly select a protein before submission'
            );
            return redirect()->back()->with($reply);
        }
        $id = $request->id;
        $amount =$this->cartAmount();
        $data = array(
            'status'=>false,
        );
        $stock=DB::table('stockdetails')->where('idstockdetails',$id)->first();
        $currentVendor=session()->get('vendor_id');
        if(!$currentVendor){

            $currentVendor=$stock->vendor_id;
        }
        if($stock->vendor_id!=$currentVendor){

            $data['message'] = 'Error!!! You have not checked out with the previous vendor';
            return response()->json($data);
        }
        if(!$stock){

            abort(404);
        }
        $vendor=DB::table('vendors')->where('idvendors',$currentVendor)->first();
        $now= time()+3600; $time=(int)date('H',$now);
        if($time>=$vendor->open_at and $time<=$vendor->close_at+12){
        }
        else{

            $data['message']='We have closed. Thank you';
            return response()->json($data);
        }

        $proteins=array();
        $proteinsAmount=0;

        for($i=0; $i<count($request->stock_protein); $i++)
        {
            $stock_id = $request->stock_protein[$i];
            $qty = $request->quantity[$i];
            $stockProteins=DB::table('stockdetails')->where('idstockdetails',$stock_id)->first();
            $perStockAmount=$stockProteins->stockprice*$qty;

            #Amount
            $proteinsAmount=$proteinsAmount+$perStockAmount;

            $proteins[]=array(

                'id'=>$stock_id,
                'qty'=>$qty,
                'name'=>$stockProteins->name,
                'price'=>$stockProteins->stockprice,
            );


        }

        $cart=session()->get('cart');

        if(!$cart)
        {
            session()->put('vendor_id',$stock->vendor_id);
        }

        $cart[$id] = [
            'stock_id'=>$stock->idstockdetails,
            "vendor_id"=>$stock->vendor_id,
            "name"=>$stock->name,
            "quantity"=>1,
            "price"=>$stock->stockprice+$proteinsAmount,
            "proteins"=>$proteins
        ];

        session()->put('cart',$cart);

        return redirect()->back()->with('message','cart updated successfully');
    }

    public function update(Request $request)
    {

        if($request->id and $request->quantity){

            $cart = session()->get('cart');

            // for($i=0; $i<count($request->id); $i++){

            //     $cart[$request->id[$i]]['quantity']=$request->quantity[$i];

            //     session()->put('cart',$cart);
            // }

            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart',$cart);
            $amount =$this->cartAmount();

            $view = view("jquery.cartshow")->render();

            $data['html']=$view;
            $headercart=view("jquery.cart_header")->render();
            $data['headercart']=$headercart;
            $data['message']='cart updated successfully';
            $data['alert-type']='info';
            $data['status']=true;
            return response()->json($data);
        }


    }

    public function remove(Request $request)
    {
        $id = $request->id;

        if($id){

            $cart = session()->get('cart');

            if(isset($cart[$id])){

                unset($cart[$id]);

                session()->put('cart',$cart);
                $amount =$this->cartAmount();
                if(count($cart)==0){
                    session()->forget('vendor_id');
                    session()->forget('cart');
                }
            }
            $view = view("jquery.cartshow")->render();
            $data['html']=$view;
            $headercart=view("jquery.cart_header")->render();
            $data['headercart']=$headercart;
            $data['message']='cart updated successfully';
            $data['alert-type']='info';
            $data['status']=true;
            return response()->json($data);

            // return redirect()->back()->with('cartSuccess','cart updated successfully');
        }
    }

    public function test(){

        // var_dump(session('cart'));
        // &#8358
        // print_r($this->cartAmount());
        // print_r(session()->get('cartAmount'));
        // session()->flush();

        // $id=$this->user()->idvendors;
        // $vendors=DB::table('vendors')
        // ->join('regions','regions.idregions','=','vendors.region_id')
        // ->join('categories','categories.idcategories','=','vendors.category_id')
        // ->where('vendors.idvendors',$id)
        // ->get();

        // $stock_categories=DB::table('stockcategories')->where('vendor_id',$id)->get();
        // $stock_details = array();

        // foreach($stock_categories as $stock_category){
        //     $lists = DB::table('stockdetails')->where('stock_category_id',$stock_category->idstockcategories)->get();
        //     $test = json_decode(json_encode($lists));
            
        //     $view[]=[$stock_category->name=>$lists];
        //     $show=json_decode(json_encode($view));
        // }

        // for($i=0; $i<count($show); $i++){
        //     foreach($show[$i] as $value=>$t){
        //         echo $value;
        //         for($j=0; $j<count($t); $j++){
        //             echo '<br>'.$t[$j]->name;
        //         }
        //         echo'<br><br>';
        //     }
            

        // }
        // $data=array();


        // Mail::send('mails.welcome',$data, function($message){
        //     $message->from('foodxyme@gmail.com','Welcome Note');
        //     $message->to('babalolaisaac@gmail.com');
        // });
        // return view('mails.welcome');

        // echo url('');
        // $redirect_url= route('payment-verification');
        // echo $redirect_url;

        print_r(session()->get('cart'));
    
    }



}
