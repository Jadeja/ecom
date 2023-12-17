<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Session;
use Image;
use Str;
class ProductController extends Controller
{
    public function products(){
        Session::put("page","products");
        $products = Product::with(["category" => function($query){
            $query->select('id','category_name');
        },"section" => function($query){
            $query->select('id','name');
        }])->get();
        //echo "<pre>"; print_r($products); die;
        return view("admin.products.product",compact('products'));
    }

    public function updateStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            Product::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"product_id" => $data["id"]]);
        }
    } 
    
    public function addEditProducts(Request $request,$id=null){
        if($id==null){
            $title ="Add Product";
            $product = new Product();
            $msg = "You have successfully added new product";
        }
        else{
            $title="Edit Product";
            $product = Product::find($id);
            $msg = "You have successfully Updated the product";
        }

        if($request->isMethod("post")){
            $data = $request->all();
            $rule =[
                "category_id" => "required",
                "brand" => "required",
                "product_name" => "required|regex:/^[\pL\s\-]+$/u",
                "product_code" => "required|regex:/^[\w-]*$/",
                "product_color" => "required|regex:/^[\pL\s\-]+$/u",
                "product_price" => "required|numeric",
            ];

            $messeges =[
                "category_id.required" => "Category Name is Required",
                "product_name.required" => "Product Name is required",
                "product_name.regex" => "Valid Product Name is required",
                "product_code.required" => "Product code is required",
                "product_code.regex" => "Valid Product code is required",
                "product_color.required" => "Product color is required",
                "product_color.regex" => "Valid Product color is required",
                "product_price.required" => "Product price is required",
                "product_price.numeric" => "Valid Product price is required",                                                
            ];

            $this->validate($request,$rule,$messeges);
            $cat = Category::where('id',$request->category_id)->select('id','section_id')->first();
            $cat = json_decode(json_encode($cat,true));
            //echo "<pre>";print_r($cat); die;
            if(isset($data["is_featured"]) && $data["is_featured"] == "on"){
                $is_featured = "Yes";
            }else{
                $is_featured = "No";                
            }
            
            
            if(empty($data["product_weight"])){
                $data["product_weight"]="";
            }

            if(empty($data["description"])){
                $data["description"]="";
            }

            if(empty($data["wash_care"])){
                $data["wash_care"]="";
            }
            if(empty($data["fabric"])){
                $data["fabric"]="";
            }
            if(empty($data["pattern"])){
                $data["pattern"]="";
            }
            if(empty($data["sleeve"])){
                $data["sleeve"]="";
            }
            if(empty($data["fit"])){
                $data["fit"]="";
            }
            if(empty($data["occasion"])){
                $data["occasion"]="";
            }
            if(empty($data["meta_title"])){
                $data["meta_title"]="";
            }
            if(empty($data["meta_keywords"])){
                $data["meta_keywords"]="";
            }
            if(empty($data["meta_description"])){
                $data["meta_description"]="";
            }

            // image upload code
            if($request->hasFile("main_image")){
                $tmp_image = $request->file("main_image");
                if($tmp_image->isValid()){
                    $name = $tmp_image->getClientOriginalName();
                    $ext  = $tmp_image->getClientOriginalExtension();
                    $file_name = Str::random().".".$ext; 

                    // large image upload
                    $img_small = public_path('/images/product_images/small')."/".$file_name;
                    $img_medium = public_path('/images/product_images/medium')."/".$file_name;
                    $img_large = public_path('/images/product_images/large')."/".$file_name;
                    Image::make($tmp_image)->save($img_large);
                    // midium image upload 
                    Image::make($tmp_image)->resize(520,600)->save($img_medium);
                    // small image upload 
                    Image::make($tmp_image)->resize(260,300)->save($img_small);
                    $product->main_image = $file_name;
                }
            }else{
                $product->main_image = "";
            }

            if($request->hasFile("product_video")){
                $tmp_name = $request->file('product_video');
                if($tmp_name->isValid()){
                    $name = $tmp_name->getClientOriginalName();
                    $ext  = $tmp_name->getClientOriginalExtension();
                    $name = Str::random(5).$name;
                    //dd($name);
                    $path = public_path("/videos/product_videos");
                    //dd($path);
                    $tmp_name->move($path,$name);
                    $product->product_video = $name;
                }
            }
            else{
                $product->product_video = "";
            }
//dd($data);
            $product->section_id = $cat->section_id;
            $product->category_id = $data["category_id"];
            $product->brand_id = $data["brand"];
            $product->product_name = $data["product_name"];
            $product->product_code = $data["product_code"];
            $product->product_color = $data["product_color"];
            $product->product_price = $data["product_price"];
            $product->product_discount = $data["product_discount"];
            $product->product_weight = $data["product_weight"];                         
            $product->description = $data["description"];
            $product->wash_care = $data["wash_care"];
            $product->fabric = $data["fabric"];
            $product->pattern = $data["pattern"];
            $product->sleeve = $data["sleeve"];
            $product->fit = $data["fit"];
            $product->occasion = $data["occasion"];
            $product->meta_title = $data["meta_title"];
            $product->meta_keywords = $data["meta_keywords"];
            $product->meta_description = $data["meta_description"];    
            //dd($is_featured);        
            $product->is_featured = $is_featured;            
            $product->status = 1;            
            $product->save();    
            Session::flash("success_msg",$msg);
            return redirect()->route("admin.products");
        }
        //Filter Array
        $filters = Product::filters();
        extract($filters);
        $sections = Section::with("categories")->get();
        $sections = json_decode(json_encode($sections,true));

        $brands  = Brand::where('status',1)->get();
        // print "<pre>"; print_r($p); die;
        return view("admin.products.add_edit_product",compact("product","sections","brands","title","fabricArray","sleeveArray","patternArray","fitArray","occasionArray"));
    }

    public function deleteProductImage($id){
        $product = Product::select("main_image")->where('id',$id)->first();    

        if(file_exists("images/product_images/small/".$product->main_image)){
            unlink("images/product_images/small/".$product->main_image);
        }
        if(file_exists("images/product_images/medium/".$product->main_image)){
            unlink("images/product_images/medium/".$product->main_image);
        }
        if(file_exists("images/product_images/large/".$product->main_image)){
            unlink("images/product_images/large/".$product->main_image);
        }
            $product->main_image="";
            $product->save();
            Session::flash('success_msg',"You have deleted Product Image succesfully");
        
        return redirect()->back();
    }    

    public function deleteProductVideo($id){
        $product = Product::select("product_video")->where('id',$id)->first();        
        if(file_exists("videos/product_videos/".$product->product_video)){
            unlink("videos/product_videos/".$product->product_video);
            $product->product_video="";
            $product->save();
            Session::flash('success_msg',"You have deleted product video succesfully");
        }
        return redirect()->back();
    }

    public function deleteProduct($id){
        $cat = Product::where('id',$id)->first();   
        if($cat){
            $cat->delete();
            Session::flash('success_msg',"You have  deleted product succesfully");        
        }             
        return redirect()->back();
    } 

    public function addProductAttribute(Request $request, $id) { 
        $product = Product::with("attributes")->find($id);
        $product = json_decode(json_encode($product,true));
        // echo "<pre>"; print_r($product); die;
        $title   = "Add Product Attriute";
        if($request->isMethod("Post")){
         $data = $request->all();
         foreach($data["sku"]  as $key => $value){
             if(!empty($data["sku"])){

                 $sku = ProductAttribute::where("sku",$value)->count();
                 if($sku>0){
                    Session::flash('error_msg',$value." SKU already exist in ProductAttribute Table.");        
                    return redirect()->back();
                 }

                 $size = ProductAttribute::where(["size"=>$data["size"][$key],"product_id" => $id])->count();
                 if($size>0){
                    Session::flash('error_msg',$data["size"][$key]." Size already exist in ProductAttribute Table.");        
                    return redirect()->back();
                 }

                 $pa = new ProductAttribute;
                 $pa->sku = $value;
                 $pa->product_id = $id;
                 $pa->status = 0;
                 $pa->size = $data["size"][$key];
                 $pa->stock = $data["stock"][$key];
                 $pa->price = $data["price"][$key];
                 $pa->save();
                Session::flash('success_msg',"You have added product attributes succesfully");        
                return redirect()->back();

             }
         }
        }

        return view("admin.products.add_product_attribute",compact('product','title'));
    }   

    public function editAttribute(Request $request){
        $data = $request->all();
        //print "<pre>"; print_r(json_decode(json_encode($data),true));die;
        if($request->isMethod("post")){
            foreach($data["attributeId"] as $key => $value){
                ProductAttribute::where("id",$value)->update(['stock'=>$data["stock"][$key],"price"=>$data["price"][$key]]);
            }
            Session::flash('success_msg',"You have updated ProductAttribute Succesfully.");        
            return redirect()->back();            
        }
    }

    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            ProductAttribute::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"attribute_id" => $data["id"]]);
        }
    }     

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            ProductImage::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"attribute_id" => $data["id"]]);
        }
    }

    public function addImages(Request $request,$id){
        $product = Product::with("images")->select("id","product_name","product_code","product_color","main_image")->find($id);
        if($request->isMethod('post')){
            if($request->hasFile('image')){
                $image = $request->file('image');
                foreach($image as $key => $timage){

                    $tmp_image = Image::make($timage);     
                    $ext  = $timage->getClientOriginalExtension();
                    $img = new ProductImage;
                    $file_name = Str::random().".".$ext; 

                    // large image upload
                    $img_small = public_path('/images/product_images/small')."/".$file_name;
                    $img_medium = public_path('/images/product_images/medium')."/".$file_name;
                    $img_large = public_path('/images/product_images/large')."/".$file_name;
                    Image::make($tmp_image)->save($img_large);
                    // midium image upload 
                    Image::make($tmp_image)->resize(520,600)->save($img_medium);
                    // small image upload 
                    Image::make($tmp_image)->resize(260,300)->save($img_small);
                    $img->product_image = $file_name;
                    $img->product_id = $id;
                    $img->save();
                } 
                Session::flash('success_msg',"You have added Product Images Succesfully.");        
                return redirect()->back();                
            }
        }
        $title ="Add Product Images";
        return view("admin.products.add_images")->with(compact("product","title"));
    }

    public function deleteProductAttribute(Request $request,$id){
        $productAttriute = ProductAttribute::where('id',$id)->first();   
        if($productAttriute){
            $productAttriute->delete();
            Session::flash('success_msg',"You have  deleted product attribute succesfully");        
        }             
        return redirect()->back();        
    }

    public function deleteProductImages(Request $request,$id){
        $productImage = ProductImage::where('id',$id)->first();           
        if($productImage){
            if(file_exists("images/product_images/small/".$productImage->product_image)){
                unlink("images/product_images/small/".$productImage->product_image);
            }
            if(file_exists("images/product_images/medium/".$productImage->product_image)){
                unlink("images/product_images/medium/".$productImage->product_image);
            }
            if(file_exists("images/product_images/large/".$productImage->product_image)){
                unlink("images/product_images/large/".$productImage->product_image);
            }
            $productImage->delete();
            Session::flash('success_msg',"You have  deleted product image succesfully");        
        }             
        return redirect()->back();        
    }    
}
