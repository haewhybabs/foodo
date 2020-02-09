<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category extends Controller
{
    public function index(){

        $categories=DB::table('categories')->get();
        $data=array(
            'status'=>true,
            'categories'=>$categories
        );
        return response($data,200)->header('content-Type','application/json');
    }

    public function selectedCategory($id)
    {

        $check=DB::table('categories')->where('idcategories',$id)->first();

        if(!$check){
            return response(['status'=>false,'message'=>'Category not found'],422)->header('content-Type','application/json');
        }

        $vendors=DB::table('vendors')
        ->join('regions','regions.idregions','=','vendors.region_id')
        ->join('categories','categories.idcategories','=','vendors.category_id')
        ->where('vendors.status',2)
        ->where('categories.idcategories',$id)
        ->get();

        $data = array(
            'vendors'=>$vendors,
            // 'category_name'=>$name,
            'status'=>true,
        );

        return response($data,200)->header('content-Type','application/json');
    }
}
