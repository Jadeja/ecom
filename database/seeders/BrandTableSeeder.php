<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id'=>1,'name'=>'Brand1','status'=>1],
            ['id'=>2,'name'=>'Brand2','status'=>1],
            ['id'=>3,'name'=>'Brand3','status'=>1],
            ['id'=>4,'name'=>'Brand4','status'=>1],
            ['id'=>5,'name'=>'Brand5','status'=>1],
        ];

        Brand::insert($records);
    }
}
