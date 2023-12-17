<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $pass=Hash::make("12345678");
        $adminRecords = [
            ['id'=> 1,'name'=>'admin','type'=>'admin','mobile'=>'9800000000','email'=>'kjadeja7@gmail.com','password'=>$pass,'image'=>'','status'=>1],
        ];

        DB::table('admins')->insert($adminRecords);

        // foreach ($adminRecords as $key => $value) {
        //     \App\Models\Admin::create($value);
        // }
    }
}
