<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ["id" => 1, "name" => "Mens", "status" => 1],
            ["id" => 2, "name" => "Women", "status" => 1],
            ["id" => 3, "name" => "Kids", "status" => 1],
        ];

        Section::insert($records);
    }
}
