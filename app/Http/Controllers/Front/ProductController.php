<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Cart;
use Session;
use Auth;
class ProductController extends Controller
{
    public function listing(Request $request){
        $url = Route::getFacadeRoot()->current()->uri() ;//$data['url'];
        if($request->ajax()){
            $data = $request->all();
            $count = Category::where(['url'=>$url,'status'=>1])->count();
            if($count>0){
                $categoryDetails  = Category::categoryDetails($url);
                $breadcame=$categoryDetails['breadcame'];
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);//->toArray();
    

                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProducts->whereIn('fabric',$data['fabric']);
                }
                if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProducts->whereIn('fit',$data['fit']);
                }
                if(isset($data['occassion']) && !empty($data['occassion'])){
                    $categoryProducts->whereIn('occasion',$data['occassion']);
                }
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProducts->whereIn('sleeve',$data['sleeve']);
                }
                if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProducts->whereIn('pattern',$data['pattern']);
                }                                                                

                if(isset($data['sort']) && $data['sort'] == 'latest_product'){
                    $categoryProducts->latest();
                }else if(isset($data['sort']) && $data['sort'] == 'product_name_a_z'){
                    $categoryProducts->orderby('product_name','asc');
                }else if(isset($data['sort']) && $data['sort'] == 'product_name_z_a'){
                    $categoryProducts->orderby('product_name','desc');
                }else if(isset($data['sort']) && $data['sort'] == 'product_lowest_price'){
                    $categoryProducts->orderby('product_price','asc');
                }else if(isset($data['sort']) && $data['sort'] == 'product_highest_price'){
                    $categoryProducts->orderby('product_name','desc');
                } 
                
                $categoryProducts =  $categoryProducts->paginate(10);
                return view('front.products.ajax_product_listing',compact('categoryProducts','categoryDetails','breadcame','url'));
            }
            else{
                abort(404);
            }            
        }
        else
        {
            $count = Category::where(['url'=>$url,'status'=>1])->count();
            if($count>0){
                $categoryDetails  = Category::categoryDetails($url);
                $breadcame=$categoryDetails['breadcame'];
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);//->toArray();                   
                $categoryProducts =  $categoryProducts->paginate(10);
                //Filter Array
                $filters = Product::filters();
                extract($filters);
                $page="listing";

                return view('front.products.listing',compact('page','categoryProducts','categoryDetails','breadcame','url',"fabricArray","sleeveArray","patternArray","fitArray","occasionArray"));
            }
            else{
                abort(404);
            }
        }        
    }

    public function detail($id){
        $productDetails = Product::with(['category','brand','attributes'=> function($query){
            $query->where('status',1);
        },'images'])->withSum('attributes','stock')->find($id)->toArray();
        $relatedProduct = Product::where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->inRandomOrder()->limit(3)->get()->toArray();
        return view('front.products.detail',compact('productDetails','relatedProduct'));
    }

    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $attributes = ProductAttribute::where(['product_id'=>$data['productId'],'size'=>$data['size']])->first();
            return $attributes->price;
        }
    }

    public function addToCart(Request $request){
        $data = $request->all();
        //dd($data);
        $getProductDetail = ProductAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
        if($getProductDetail["stock"] < $data["quantity"]){
            $msg = "Product stock is not available";
            Session::flash('error_msg',$msg);
            return redirect()->back();
        }

        //generate session id
        $session_id = Session::get("session_id");
        if(empty($session_id)){
            $session_id = Session::getId();
            Session::put('session_id',$session_id);
        }

        if(Auth::check()){
            $count = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
        }else{
            $count = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>$session_id])->count();
        }

        if($count > 0){
            $msg = "Product already in Cart";
            Session::flash('error_msg',$msg);
            return redirect()->back();
        }
        Cart::create(['product_id'=>$data["product_id"],'user_id'=>'0','quantity'=>$data['quantity'],'size'=>$data['size'],'session_id'=>$session_id]);
        $msg = "Product added succefully";
        Session::flash('success_msg',$msg);    
        return redirect()->back();
    }

    public function cart(){
        $cartDetails = Cart::getCartDetails();
        return view('front.products.cart',compact('cartDetails'));
    }
}
