<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;


class Customers extends Controller
{
    public function create(Request $request)
    {
        $validatedData= $request->validate([

            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'name'=>'required',
            'home_address'=>'required',
            'phone_number'=>'required',
            'region_id'=>'required',
        ]);

        $AuthenticationData=array(
            'role_id'=>1,
            'email'=>$request->email,
            'password'=>$request->password
        );

        $AuthenticationData['password']=bcrypt($request->password);

        $user=User::create($AuthenticationData);

        $vendorData=array(

            'name'=>$request->name,
            'home_address'=>$request->home_address,
            'phone_number'=>$request->phone_number,
            'status'=>1, #Pending
            'user_id'=>$user->id,
            'region_id'=>$request->region_id,
        );


        $customer=Customer::create($vendorData);

        $task=$vendorData['name'].' just created an account with FoodXyme';
        $this->audit($task,$user->id);

        $data=array(
            'message'=>'Vendor is successfully created',
            'status'=>true,
            'data'=>$customer,
        );
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token'=>$accessToken])->header('content-Type','application/json');

    }
}
