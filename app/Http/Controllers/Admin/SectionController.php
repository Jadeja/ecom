<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections(){
        Session::put("page","sections");
        $sections = Section::all();
        return view("admin.sections.admin_section",compact("sections"));
    }

    public function updateStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>";print_r($data);
            $status=1;
            if($data["status"]=="Active"){
                $status=0;
            }
            Section::where("id",$data["id"])->update(["status"=>$status]);
            return response()->json(["status" => $status,"section_id" => $data["id"]]);
        }
    }
}
