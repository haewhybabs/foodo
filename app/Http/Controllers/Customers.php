<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\DB;


class Customers extends Controller
{
    public function create(Request $request)
    {
        $validatedData= $request->validate([

            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>'required',
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
            'address'=>$request->home_address,
            'phone_number'=>$request->phone_number,
            'user_id'=>$user->id,
        );


        $customer=DB::table('customers')->insert($userData);

        $task=$userData['name'].' just created a user account with FoodXyme';
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
