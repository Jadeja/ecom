<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //$this->call([AdminTableSeeder::class]);
       // $this->call([SectionsTableSeeder::class]);
       // $this->call([CategorySeeder::class]);
        //$this->call([ProductSeeder::class]);
        //$this->call([ProductAttributesTableSeeder::class]);
        //$this->call([ProductImageSeeder::class]);
        //$this->call([BrandTableSeeder::class]);
        $this->call([BannerSeeder::class]);
        // \App\Models\User::factory(10)->create();
    }
}
