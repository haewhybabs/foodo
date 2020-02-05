<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add($id)
    {


        $stock=DB::table('stockdetails')->where('idstockdetails',$id)->first();

        $currentVendor=session()->get('vendor_id');
        if(!$currentVendor){

            $currentVendor=$stock->vendor_id;
        }

        if($stock->vendor_id!=$currentVendor){
            return redirect()->back()->with('cartError','Error!!! You have not checked out with the previous vendor');
        }

        if(!$stock){
            abort(404);
        }

        $vendor=DB::table('vendors')->where('idvendors',$currentVendor)->first();


        $now= time()+3600; $time=(int)date('H',$now);
        if($time>=$vendor->open_at and $time<=$vendor->close_at+12){
        }
        else{

            return redirect()->back()->with('error','We have closed. Thank you');
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
                ]
            ];

            session()->put('cart',$cart);
            return redirect()->back()->with('cartSuccess','Product added to cart');
        }

        if(isset($cart[$id]))
        {

            $cart[$id]['quantity']++;

            session()->put('cart',$cart);

            return redirect()->back()->with('cartSuccess','Product added to cart');
        }


        $cart[$id] = [
            'stock_id'=>$stock->idstockdetails,
            "vendor_id"=>$stock->vendor_id,
            "name"=>$stock->name,
            "quantity"=>1,
            "price"=>$stock->stockprice
        ];
        session()->put('cart',$cart);

        return redirect()->back()->with('cartSuccess','Item added to cart');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity){

            $cart = session()->get('cart');

            for($i=0; $i<count($request->id); $i++){

                $cart[$request->id[$i]]['quantity']=$request->quantity[$i];

                session()->put('cart',$cart);
            }

            return redirect()->back()->with('cartSuccess','Item cart is updated');
        }

    }

    public function remove($id)
    {
        if($id){

            $cart = session()->get('cart');

            if(isset($cart[$id])){

                unset($cart[$id]);

                session()->put('cart',$cart);
                if(count($cart)==0){
                    session()->forget('vendor_id');
                    session()->forget('cart');
                }
            }

            return redirect()->back()->with('cartSuccess','cart updated successfully');
        }
    }

    public function test(){
        // var_dump(session('cart'));
        // &#8358
        // print_r($this->cartAmount());
        // print_r(session()->get('cartAmount'));
        session()->flush();
    }

}
