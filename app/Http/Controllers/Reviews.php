<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Reviews extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function create(Request $request)
    {
        $validatedData= $request->validate([

            'vendor_id'=>'required',
            'rating'=>'required',
        ]);
        $vendor_id=$request->vendor_id;
        // $user_id=Auth::user()->id;
        // $customer=DB::table('customers')->where('user_id',$user_id)->first();
        $user_id=$this->user()->idcustomers;

        $reviewData=array(
            'vendor_id'=>$vendor_id,
            'rating'=>$request->rating,
            'review'=>$request->review,
            'customer_id'=>$user_id,
        );
        DB::table('vendorsreviews')->insert($reviewData);

        //update Vendors Table

        $vendorReviews=DB::table('vendorsreviews')->where('vendor_id',$vendor_id)->get();
        $count=count($vendorReviews);
        $total=0;
        foreach($vendorReviews as $review){
            $total=$total+$review->rating;
        }
        $vendorRating=$total/$count;

        DB::table('vendors')->where('idvendors',$vendor_id)->update(['rating'=>$vendorRating]);

        $data=array(
            'message'=>'success',
            'status'=>true
        );

        return response($data,200)->header('content-Type','application/json');
    }


}
