<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{
    public function getBrands(){
        Session::put("page","Brands");
        $brands = Brand::get();
        return view('admin.brands.brands',compact('brands'));
    }

    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            Brand::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"brand_id" => $data["id"]]);
        }
    }   
    public function addUpdateBrands(Request $request,$id=null){
        if($id==""){
           $brand = new Brand;
           $message = "Brand Added Succesfully";
           $title = "Update Brand";
        }else{
            $title = "Add Brand";
            $brand = Brand::find($id);
            $message = "Brand Updated Succesfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $rules =[
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',          
            ];

            $error_msg=[
                'brand_name.required' => 'brand name is required',
                'brand_name.regex'=>'Please enter valid brand name',
            ];

            $this->validate($request,$rules,$error_msg);

            $brand->name = $data["brand_name"];
            $brand->status = 1;
            $brand->save();
            session::flash('success_msg',$message);

            return redirect()->route('admin.brands');
        }
        return view('admin.brands.add-edit-brand',compact('title','brand')) ;
    }   
    
    public function deleteBrand(Request $request,$id){
        $brand = Brand::where('id',$id)->first();   
        if($brand){
            $brand->delete();
            Session::flash('success_msg',"You have deleted brand succesfully");        
        }             
        return redirect()->back();        
    }
    
}
