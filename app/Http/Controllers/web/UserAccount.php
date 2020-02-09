<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;

class UserAccount extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id=Auth::user()->id;
        $transactions=DB::table('transactions')->select('ordersummaries.*','transactions.reference','vendors.store_name')
        ->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
        ->join('users','users.id','=','ordersummaries.user_id')->join('vendors','vendors.idvendors','=','ordersummaries.vendor_id')

        ->where('ordersummaries.user_id',$user_id)->where('transactions.status',1)
        ->orderBy('ordersummaries.idordersummaries','desc')->paginate(5);

        $data=array(
            'user'=>$this->user(),
            'transactions'=>$transactions,
        );
        return view('web.customer.userspage')->with($data);
        // print_r($transactions);
    }
    public function confirmDelivery($ref){

        $trans= DB::table('transactions')->where('reference',$ref)->first();
        DB::table('ordersummaries')->where('idordersummaries',$trans->order_summaries_id)->update(['status'=>2]);
        return redirect('user-account')->with('message',"It's nice working with you!!! See you soon");
    }

    public function thankyou($ref)
    {
        $data = array(
            'transaction'=>DB::table('transactions')->where('reference',$ref)->first(),
        );
        return view('web.thankyou')->with($data);
    }

    public function editProfile(Request $request)
    {
        $validatedData= $request->validate([

            'address'=>'required',
            'phone_number'=>'required',
            'name'=>'required',
        ]);
        $user_id = $this->user()->idcustomers;

        DB::table('customers')->where('idcustomers',$user_id)->update($validatedData);
        return redirect()->back()->with('message','Account Updated Successfully');

    }
}
