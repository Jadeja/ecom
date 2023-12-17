<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Admin;
use Hash;
use Str;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put("page","dashboard");
        return view('admin.admin_dashboard');
    }
    public function settings(){
        Session::put("page","settings");
        $admin_details = Admin::find(Auth::guard('admin')->user()->id);
        //dd($admin_details);
        return view('admin.admin_settings',compact('admin_details'));
    }

    public function login(Request $request){

        if($request->isMethod("post")){

            $rules =[
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
    
            $error_messages=[
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];
    
            $this->validate($request,$rules,$error_messages);

            if(Auth::guard("admin")->attempt($request->only("email","password")))
            {
                return redirect("/admin/dashboard");
            }else
            {
                Session::flash("error_msg","Username or Password Incorrect");
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    public function logout(){
        Auth::guard("admin")->logout();
        return redirect('/admin');
    }

    public function currentPwd(Request $request){
        $data=$request->all();
        if(Hash::check($data["currentpwd"],Auth::guard("admin")->user()->password)){
            echo "true";
        }
        else{
            echo "false";
        }
    }

    public function updateCurrentPwd(Request $request){
        $data = $request->all();
        if(Hash::check($data["current_pwd"],Auth::guard("admin")->user()->password)){
            if($data["new_pwd"] == $data["confirm_pwd"]){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(["password" => bcrypt($data["new_pwd"])]);
                Session::flash("success_msg","Your have updated your current Password Successfully");
            }
            else{
                Session::flash("error_msg","Your new and confirmed password are not matching.");
            }
        }
        else{
            Session::flash("error_msg","Your current Password is incorrect");
        }
        return redirect()->back();
    }

    public function updateAdminDetails(Request $request) {
        Session::put("page","update-admin-details");
        
        if($request->isMethod("post")){
            $rules =[
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image'
            ];

            $error_msg=[
                'admin_name.required' => 'Admin name is required',
                'admin_mobile.required' => 'Admin mobile number is required',
                'admin_name.regex'=>'Enter valid admin name',
                'admin_mobile.numeric'=>'Enter valid mobile number',
                'admin_image.image'=>'Upload Valid Image',
            ];

            $this->validate($request,$rules,$error_msg);
            $data = $request->all();
            if($request->hasFile("admin_image") ){
                $tmp_image = $request->file("admin_image");
                //$tmp_image = $data["admin_image"];
                if($tmp_image->isValid()){ //&& $tmp_image instanceof UploadedFile){

                   // $absolute_path = public_path($dir);     //Str::random();
                    $name = $tmp_image->getClientOriginalName();
                    $ext = $tmp_image->getClientOriginalExtension();
                    $new_name=Str::random().'.'.$ext;
                    //$dir = 'images'.'/'.'profile_images'.'/'.$new_name;
                    //Image::make($tmp_image)->save($dir);
                    $tmp_image->move('images'.'/'.'profile_images'.'/',$new_name);
                }
            }
            elseif(!empty($data["old_image"])){
                $new_name=$data["old_image"];
            }else{
                $new_name="";
            }
            Admin::where('id',Auth::guard('admin')->user()->id)->update(["name" => $data["admin_name"],"mobile" => $data["admin_mobile"],"image" => $new_name]);
            Session::flash("success_msg","Your have updated your information successfully.");
        }

        $admin_details = Admin::find(Auth::guard('admin')->user()->id);
        
        return view('admin.update_admin_details',compact('admin_details'));
    }
}
