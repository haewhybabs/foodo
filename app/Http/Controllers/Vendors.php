<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class Vendors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendorData= $request->validate([

            'manager_name'=>'required',
            'store_name'=>'required',
            'address'=>'required',
            'phone_number'=>'required',
            'status'=>'required',
            'description'=>'required',
            'user_id'=>'required',
            'category_id'=>'required',
            'region_id'=>'required',
            'open_at'=>'required',
            'close_at'=>'required',
        ]);

        #Pending
        $vendorData['status']=1;

        $vendor=Vendor::create($vendorData);
        $data=array(
            'message'=>'Vendor is successfully created',
            'status'=>true,
        );

        return response($data,200)->header('content-Type','application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
