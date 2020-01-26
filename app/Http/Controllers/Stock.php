<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Stock extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        #Stock Categeory List

        $user_id=Auth::user()->id;

        $categoryList=DB::table('stockcategories')->where('vendor_id',$user_id)->get();
        $data=array(
            'status'=>true,
            'data'=>$categoryList
        );
        return response($data,200)->header('content-Type','application/json');

    }

    public function list()
    {
        $user_id=Auth::user()->id;

        $stockList=DB::table('stockdetails')
        ->join('stockcategories','stockdetails.stock_category_id','=','stockcategories.idcategories')
        ->where('stockdetails.vendor_id',$user_id)->get();

        $data=array(
            'status'=>true,
            'data'=>$stockList,
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


        $validatedData= $request->validate([

            'description'=>'required',
            'name'=>'required',
            'stockprice'=>'required',
            'stock_category_id'=>'required',
        ]);
        $user_id=Auth::user()->id;

        if($request->has('image')){
            $fileName=substr(sha1(rand()), 0, 10).$user_id.$request->name.'.'.$request->file('image')->extension();
            $path=$request->file('image')->move(public_path('/stockimages'),$fileName);
            $photoURL=url('/stockimages'.$fileName);

            $validatedData['image']=$photoURL;
        }else{

            $validatedData['vendor_id']=$user_id;
        }


        $data=DB::table('stockdetails')->insert($validatedData);
        return response()->json($data,422)->header('content-Type','application/json');

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
