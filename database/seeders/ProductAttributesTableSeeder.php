<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ["id"=>1,"product_id"=>1,"size"=>"small","price"=>1000,"stock"=>"20","sku"=>"BT001-S","status"=>1],
            ["id"=>2,"product_id"=>1,"size"=>"medium","price"=>1200,"stock"=>"20","sku"=>"BT001-M","status"=>1],
            ["id"=>3,"product_id"=>1,"size"=>"large","price"=>1300,"stock"=>"10","sku"=>"BT001-L","status"=>1],
        ];

        ProductAttribute::insert($records);
    }
}
