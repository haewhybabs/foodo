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


        $getTransaction=DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
        ->join('users','users.id','=','ordersummaries.user_id')->where('ordersummaries.vendor_id',$vendor_id)->where('transactions.status',1)->get();

        // $getDetails=DB::table('transactions')->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
        // ->join('orderdetails','orderdetails.order_summaries_id','=','ordersummaries.idordersummaries')->join('stockdetails','orderdetails.stock_details_id','=','stockdetails.idstockdetails');



        $data=array(
            'stockcategories'=>$stock_category,
            'user'=>$user,
            'transactions'=>$getTransaction,
        );
        return view('web.vendor.orders')->with($data);

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

        DB::table('ordersummaries')->where('idordersummaries',$id)->update(['status'=>1]);
        return redirect('vendor-account')->with('message','Food successfully set on delivery');
    }
}
