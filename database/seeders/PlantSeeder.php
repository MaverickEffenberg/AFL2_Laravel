<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
       
        

        DB::table('plants')->insert([
            [
                'name' => 'Venus Flytrap',
                'category_id'=> 1,

                'image_url' => 'images/venus.jpg',
                'price' => 120000,
                'stock' => 25,
            ],
            [
                'name' => 'Pitcher Plant',
                'category_id'=> 2,

                'image_url' => 'images/pitcher.jpg',
                'price' => 180000,
                'stock' => 18,

            ],
            [
                'name' => 'Sundew',
                'category_id'=> 1,

                'image_url' => 'images/sundew.jpg',
                'price' => 95000,
                'stock' => 32,

            ],
            [
                'name' => 'Cobra Lily',
                'category_id'=> 3,

                'image_url' => 'images/cobra.jpg',
                'price' => 210000,
                'stock' => 0,
             ],
            [
                'name' => 'Butterwort',
                'category_id'=> 4,

                'image_url' => 'images/butterwort.jpg',
                'price' => 85000,
                'stock' => 40,

            ],
        ]);
    }
}
