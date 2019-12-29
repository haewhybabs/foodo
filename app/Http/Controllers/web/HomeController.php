<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $category=DB::table('categories')->get();
        $data=array(
            'categories'=>$category,
        );
        return view('web.index')->with($data);
    }

    public function category($name)
    {
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
}
