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
            'data'=>$categories
        );
        return response($data,200)->header('content-Type','application/json');
    }
}
