<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Barbor Shop',
            'Candy Store',
            'Candle Store',
            'Drug Store',
            'Bait Store',
            'Hair Salon',
            'Fabric Store',
            'American',
            'Restaurant',
            'Gun Store',
            'Laundary Store',
            'Gun Shop'
        ];

        foreach($categories as $category) {
          Category::updateOrCreate(['name' => $category]);
        }
    }
}
