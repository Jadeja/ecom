<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Session;
use Str;
class CategoryController extends Controller
{
    public function categories(){
        Session::put("page","categories");
        $categories = Category::with(["section","parentCategory"])->get();
        //echo "<pre>"; dd($categories); die;
        return view("admin.categories.admin_category",compact("categories"));
    }


    public function updateStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            Category::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"category_id" => $data["id"]]);
        }
    } 
    
    public function addEditCategories(Request $request,$id=null){
        $title="Add Category";
        $sections = Section::all();
        if($id == ""){
            $title="Add Category";
            $category = new Category;
            $categories = null;

        }else{
            $title="Edit Category";
            $category = Category::where('id',$id)->first();  
            $categories = Category::with('subcategories')->where(['parent_id'=> 0,'section_id' => $category->section_id])->get();
            $categories = json_decode(json_encode($categories,true));
            //echo "<pre>"; print_r($categories); die;
        }
        if($request->isMethod("post")){
            //echo "<pre>";print_r($request->all());
            $rules =[
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'image' => 'image'
            ];

            $error_msg=[
                'category_name.required' => 'Category name is required',
                'section_id.required' => 'Section name is required',
                'category_name.regex'=>'Please enter valid category name',
                'url.required' => 'Enter valid URL ',
                'image.image'=>'Upload Valid Image',
            ];

            $this->validate($request,$rules,$error_msg);

            $data=$request->all();
            $name="";
            if($request->hasFile("image")){
                $image=$data['image'];
                if($image->isValid()){// && $image instanceof UploadedFile){
                    $originalName = $image->getClientOriginalName();
                    $ext          = $image->getClientOriginalExtension();
                    $name         = Str::random().".".$ext;
                    $image->move("images/category_images/",$name);
                }
            }
                $category->parent_id = $data["parent_id"];
                $category->section_id = $data["section_id"];
                $category->category_name = $data["category_name"];
                $category->description = $data["category_description"]??"";
                $category->category_discount = $data["category_discount"];
                $category->url = $data["url"];
                $category->category_image = $name;
                $category->meta_title = $data["meta_title"]?? "";
                $category->meta_keywords = $data["meta_keywords"]?? "";
                $category->meta_description = $data["meta_description"]?? "";
                $category->status = 1;
                $category->save();

                Session::flash('success_msg',"You have added ".$data["category_name"]." category succesfully");
               return redirect()->route("admin.categories");            
        }
        return view('admin.categories.add_edit_category',compact('title','sections','categories','category'));
    }


    public function appendCategoriesLevel(Request $request){
        $data = $request->all();
        $categories= Category::with("subcategories")->where(["section_id" => $data['id'],"parent_id" => 0,"status" => 1])->get();
        $categories = json_decode(json_encode($categories,true));
        //echo "<pre>"; print_r($res);exit;
        return view('admin.categories.append_categories_level',compact('categories'));
    }


    public function deleteCategoryImage($id){
        $cat = Category::where('id',$id)->first();        
        if(file_exists("images/category_images/".$cat->category_image)){
            unlink("images/category_images/".$cat->category_image);
            $cat->category_image="";
            $cat->save();
            Session::flash('success_msg',"You have  deleted category image succesfully");
        }
        return redirect()->back();
    }

    public function deleteCategory($id){
        $cat = Category::where('id',$id)->first();                
        $cat->delete();
        Session::flash('success_msg',"You have  deleted category succesfully");        
        return redirect()->back();
    }    
}
