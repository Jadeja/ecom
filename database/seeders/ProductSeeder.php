<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $records=[
["id"=>1,"category_id"=>2,"section_id"=>1,"product_name"=>"Blue T-shirt","product_code"=>"B001","product_color"=>"Red","product_price"=>"1500","product_discount"=>"10","product_weight"=>200,
"product_video"=>"","main_image"=>"","description"=>"Test Product","wash_care"=>"","fabric"=>"","pattern"=>"","sleeve"=>"","fit"=>"","occasion" => "",
"meta_title"=>"","meta_keywords"=>"","meta_description"=>"","is_featured"=>"No","status"=>"1"],
["id"=>2,"category_id"=>2,"section_id"=>1,"product_name"=>"White T-shirt","product_code"=>"B002","product_color"=>"White","product_price"=>"1500","product_discount"=>"10","product_weight"=>200,
"product_video"=>"","main_image"=>"","description"=>"Test Product","wash_care"=>"","fabric"=>"","pattern"=>"","sleeve"=>"","fit"=>"","occasion" => "",
"meta_title"=>"","meta_keywords"=>"","meta_description"=>"","is_featured"=>"No","status"=>"1"]

        ];

        Product::insert($records);
    }
}
