<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category',"category_id");
    }

    public function section(){
        return $this->belongsTo('App\Models\Section',"section_id");
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand',"brand_id");
    }

    public function attributes(){
        return $this->hasMany("App\Models\ProductAttribute");
    }

    public function images(){
        return $this->hasMany("App\Models\ProductImage");
    }

    public static function filters(){

        $filters["fabricArray"] = array("Cotton","Polyester","Wool");
        $filters["sleeveArray"] = array("Full Sleeve","Half Sleeve","Short Sleeve","Sleevelees");
        $filters["patternArray"] = array("Checked","Plain","Printed","Self","Solid");
        $filters["fitArray"] = array("Regular","Slim");
        $filters["occasionArray"] = array("Casual","Formal");
        return $filters;
    }
}
