<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;

class HomeController extends Controller
{
    public function index()
    {

        $category=DB::table('categories')->get();
        $city=DB::table('cities')->get();

        $data=array(
            'categories'=>$category,
            'cities'=>$city,
        );

        return view('web.index')->with($data);
    }

    public function category($name)
    {
        $check=DB::table('categories')->where('name',$name)->first();

        if(!$check){
            return redirect('/');
        }

        $category=DB::table('categories')->get();

        $vendors=DB::table('vendors')
        ->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.status',2)
        ->where('categories.name',$name)
        ->get();

        $data = array(
            'vendors'=>$vendors,
            'category_name'=>$name,
            'categories'=>$category
        );
        return view('web.listing')->with($data);
    }

    public function vendorDetails($name,$id,$vendor)
    {
        $cartAmount=$this->cartAmount();
        $vendor=DB::table('vendors')
        ->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.store_name',$vendor)
        ->where('vendors.idvendors',$id)
        ->first();

        $stock_category=DB::table('stockcategories')->where('vendor_id',$id)->get();

        $data = array(
            'vendor'=>$vendor,
            'category_name'=>$name,
            'stockcategories'=>$stock_category,
            'id'=>$id
        );

        return view('web.detail')->with($data);
    }

    public function login(){

        return view('web.userLogin');
    }

    public function loginPost(Request $request)
    {

        $loginData= $request->validate([

            'email'=>'email|required',
            'password'=>'required'
        ]);

        if(!auth()->attempt($loginData)){
            return redirect('login')->with('error','Invalid Credentials');
        }
        else{

            if(session()->get('CheckoutButNotUnthenticated')){

                return redirect('checkout');
            }

            $role_id=Auth::user()->role_id;
            if($role_id==1){
                return redirect('/');
            }
            elseif($role_id==2){
                return redirect('vendor-account');
            }

        }

    }

    public function register()
    {

        return view('web.userRegister');
    }

    public function registerPost(Request $request)
    {
        $validatedData= $request->validate([

            'address'=>'required',
            'phone_number'=>'required',
            'name'=>'required',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
        ]);


        $AuthenticationData=array(
            'role_id'=>1,
            'email'=>$request->email,
            'password'=>$request->password
        );

        $AuthenticationData['password']=bcrypt($request->password);

        $user=User::create($AuthenticationData);

        $userData=array(

            'name'=>$request->name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
            'user_id'=>$user->id,
        );

        DB::table('customers')->insert($userData);

        $task=$userData['name'].' just created a user account with FoodXyme';
        $this->audit($task,$user->id);

        return redirect('login')->with('message','Registration Successful!! Kindly login!');



    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }

    public function vendorRegister()
    {
        $data=array(
            'regions'=>DB::table('regions')->get(),
            'categories'=>DB::table('categories')->get(),
        );
        return view('web.vendorRegister')->with($data);
    }

    public function vendorRegisterPost(Request $request)
    {

        $validatedData= $request->validate([

            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',

            'manager_name'=>'required',
            'store_name'=>'required',
            'address'=>'required',
            'phone_number'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'region_id'=>'required',
            'open_at'=>'required',
            'close_at'=>'required',
        ]);

        $AuthenticationData=array(
            'role_id'=>2,
            'email'=>$request->email,
            'password'=>$request->password
        );

        $AuthenticationData['password']=bcrypt($request->password);

        $user=User::create($AuthenticationData);

        $vendorData=array(
            'manager_name'=>$request->manager_name,
            'store_name'=>$request->store_name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
            'status'=>1, #Pending
            'description'=>$request->description,
            'user_id'=>$user->id,
            'category_id'=>$request->category_id,
            'region_id'=>$request->region_id,
            'open_at'=>$request->open_at,
            'close_at'=>$request->close_at,
        );


        $vendor=DB::table('vendors')->insert($vendorData);
    }

    public function vendorSearch(Request $request){

        $validate = $request->validate([
            'search'=>'required'
        ]);

        $input = $request->search;
        $category=DB::table('categories')->get();

        $vendors=DB::table('vendors')->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.store_name','like','%'.$input.'%')
        ->where('vendors.status',2)
        ->get();

        $data = array(
            'vendors'=>$vendors,
            'categories'=>$category
        );
        return view('web.searchlisting')->with($data);





    }
}
