<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ["id"=>1,"product_id"=>1,"product_image"=>"image12.png","status"=>"1"]
        ];
        ProductImage::insert($records);
    }
}
