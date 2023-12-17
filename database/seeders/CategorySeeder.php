<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records=[
            ["id"=>1,"parent_id"=>0,"section_id"=>1,"category_name"=>"T-Shirts","category_discount"=>'0.0','category_image'=>'','description'=>'t-shirts',"url"=>'',
            'meta_title'=>'','meta_keywords'=>'','meta_description'=>'','status'=>1],
            ["id"=>2,"parent_id"=>1,"section_id"=>1,"category_name"=>"Casual T-Shirts","category_discount"=>'0.0','category_image'=>'','description'=>'casual t-shirts',"url"=>'',
            'meta_title'=>'','meta_keywords'=>'','meta_description'=>'','status'=>1]
        ];

        Category::insert($records);
    }
}
