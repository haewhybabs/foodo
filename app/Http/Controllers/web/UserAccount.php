<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\BaseController;
use App\User;
use App\Customer;

class UserAccount extends Controller
{
    use BaseController;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id=Auth::user()->id;
        $customer_id=$this->user()->idcustomers;
        $transactions=DB::table('transactions')->select('ordersummaries.*','transactions.reference','vendors.store_name')
        ->join('ordersummaries','ordersummaries.idordersummaries','=','transactions.order_summaries_id')
        ->join('users','users.id','=','ordersummaries.user_id')->join('vendors','vendors.idvendors','=','ordersummaries.vendor_id')

        ->where('ordersummaries.user_id',$user_id)->where('transactions.status',1)
        ->orderBy('ordersummaries.idordersummaries','desc')->paginate(5);

        $getCredits = DB::table('credits')->where('user_id',Auth::user()->id)->get();
        
        $getFavourites = DB::table('favourites')->where('customer_id',$customer_id)->get();
        
        $favourites=array();
        $favouriteVendors=array();

        foreach($getFavourites as $f)
        {

            if(!in_array($f->vendor_id,$favourites)){
                $favourites[] = $f->vendor_id;
            }
        }

        foreach($favourites as $favourite ){
            $favouriteVendors[]=DB::table('vendors')->join('categories','categories.idcategories','=','vendors.category_id')
            ->where('vendors.idvendors',$favourite)->first();
        }

        $data=array(

            'user'=>$this->user(),
            'transactions'=>$transactions,
            'credits'=>$getCredits,
            'favouriteVendors'=>$favouriteVendors,
        );

        
        
        return view('web.customer.userspage')->with($data);
        // print_r(json_encode($favouriteVendors));
    }
    public function confirmDelivery($ref){

        $trans= DB::table('transactions')->where('reference',$ref)->first();
        DB::table('ordersummaries')->where('idordersummaries',$trans->order_summaries_id)->update(['status'=>3]);
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

    public function creditWallet(Request $request)
    {
        session()->put('walletAmount',$request->amount);
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length=16;
        $reference=substr(str_shuffle(str_repeat($pool, 5)), 0, $length);

        $email=Auth::user()->email;
        $amount=$request->amount;
        $ref=$reference;
        $redirect_url=$this->url.'wallet-payment-verification';

        return $this->userPayment($email,$amount,$ref,$redirect_url);


    }

    public function walletVerify()
    {
        
        $amount =session()->get('walletAmount');

        if (isset($_GET['txref'])) {
            $ref=$_GET['txref'];

            if($this->flutterwaveVerify($amount,$ref)==true){

                $data=array(
                    'user_id'=>Auth::user()->id,
                    'amount'=>$amount,
                    'reference'=>$ref,
                );
                DB::table('credits')->insert($data);

                $wallet = array(
                    'amount'=>$this->walletMoney(),
                );
                $customer_id = $this->user()->idcustomers;

                DB::table('customers')->where('idcustomers',$customer_id)->update($wallet);

                session()->forget('walletAmount');
                return redirect('user-account')->with('message','Your Transaction was successful !!!');
            }
    
            else {
                return redirect('user-account')->with('error','Error ocurred !!!');
            }
        }
        else {
            die('No reference supplied');
        }
    }
}
