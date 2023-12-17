<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subcategories(){
        return $this->hasMany("App\Models\Category","parent_id")->where('status','1');
    }

    public function section(){
        return $this->belongsTo("App\Models\Section","section_id")->select("id","name");
    }

    public function parentCategory(){
        return $this->belongsTo("App\Models\Category","parent_id")->select("id","category_name");
    }

    public static function categoryDetails($url){
        $catDetails = Category::select('id','parent_id','category_name','url','description')->with(['subcategories' => function($query){
            $query->select('id','parent_id','category_name','url','description')->where('status',1);
        }])->where(['url'=>$url])->first();
        $catIds=[];
        $catIds[]=$catDetails->id;
        $breadcame="";
        if($catDetails['parent_id'] == 0){
            $breadcame='<a href="'.url('/'.$catDetails->url).'">'.$catDetails->category_name.'</a>';
        }
        else{
            $sub_cat= Category::where('id',$catDetails->parent_id)->select('id','url','category_name')->first();
            
            $breadcame='<a href="'.url('/'.$sub_cat->url).'">'.$sub_cat->category_name.'</a><span class="divider">/</span><a href="'.url('/'.$catDetails->url).'">'.$catDetails->category_name.'</a>';
        }
        foreach($catDetails->subcategories as $key => $val){
            $catIds[]=$val->id;
        }
        return array('catIds'=>$catIds,'catDetails'=>$catDetails,'breadcame'=>$breadcame);
    }
}
