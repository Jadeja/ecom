<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id'=>1,'image'=>'banner1.png','link'=>'#','title'=>'Title1','alt'=>'banner1','status'=>1],
            ['id'=>2,'image'=>'banner2.png','link'=>'#','title'=>'Title2','alt'=>'banner2','status'=>1],
            ['id'=>3,'image'=>'banner3.png','link'=>'#','title'=>'Title3','alt'=>'banner3','status'=>1]
        ];

        Banner::insert($records);
    }
}
