<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $count = Product::where('is_featured','Yes')->where('status',1)->count();
        $list = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
        $array_chunck = array_chunk($list,4);
        $page_name = "index";

        $products = Product::orderBy('id','Desc')->where('status',1)->limit(3)->get()->toArray();
        return view('front.index',compact('page_name','array_chunck','count','products'));
    }
}
