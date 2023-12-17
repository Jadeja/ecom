<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Str;
use Image;
class BannersController extends Controller
{
    public function index(){
        Session::put('page',"Banners");
        $banners = Banner::all();
        return view('admin.banners.index',compact('banners'));       
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            Banner::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"banner_id" => $data["id"]]);
        }
    } 

    public function deleteBanner(Request $request,$id){
        $banner = Banner::where('id',$id)->first();   
        if($banner){
            if(file_exists(public_path().'/images/banner_images/'.$banner->image)){
                unlink(public_path().'/images/banner_images/'.$banner->image);
            }
            $banner->delete();
            Session::flash('success_msg',"You have deleted banner succesfully");        
        }             
        return redirect()->back();        
    }

    public function addEditBanner($id=null, Request $request){

        if(empty($id)){
            $title = "Add new Banner";
            $banner = New Banner;
            $msg = "Banner added successfully";
        }else{
            $banner = Banner::find($id);
            $title = "Edit Banner";
            $msg = "Banner updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $banner->title = $data["title"];
            $banner->link = $data["link"];
            $banner->alt = $data["alt"];
            $banner->status = 1;

            if($request->hasFile("image")){
                $tmp_image = $request->file("image");
                if($tmp_image->isValid()){
                    $name = $tmp_image->getClientOriginalName();
                    $ext  = $tmp_image->getClientOriginalExtension();
                    $file_name = Str::random().".".$ext; 

                    // large image upload                  
                    $img_large = public_path('/images/banner_images')."/".$file_name;
                    // midium image upload 
                    Image::make($tmp_image)->resize(1170,480)->save($img_large);                   
                    $banner->image = $file_name;
                }
            }    
            $banner->save();
            session::flash('success_msg',$msg);
            return redirect()->route('admin.banners');        
        }

        return view('admin.banners.add_edit_banner',compact('title','banner'));
    }
}
