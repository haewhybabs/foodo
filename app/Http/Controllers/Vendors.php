<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\User;
use Illuminate\Support\Facades\DB;


class Vendors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors=DB::table('vendors')
        ->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.status',2)
        ->get();

        $data=array(
            'status'=>true,
            'data'=>$vendors
        );
        return response($data,200)->header('content-Type','application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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


        $vendor=Vendor::create($vendorData);

        $accessToken = $user->createToken('authToken')->accessToken;

        $task=$vendorData['store_name'].' just created an account with FoodXyme';
        $this->audit($task,$user->id);
        $data=array(
            'message'=>'Vendor is successfully created',
            'status'=>true,
            'data'=>$vendor,
        );

        return response(['user'=> $user, 'access_token'=>$accessToken])->header('content-Type','application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendors=DB::table('vendors')
        ->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.idvendors',$id)
        ->get();

        $data=array(
            'status'=>true,
            'data'=>$vendors
        );
        return response($data,200)->header('content-Type','application/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
