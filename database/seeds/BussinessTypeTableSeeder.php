<?php

use Illuminate\Database\Seeder;
use App\Models\BussinessType;

class BussinessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Bait And Tackde',
            'Hair Spa',
            'Fabric Store',
            'Candle Shop',
            'Gun And Arms'
        ];

        foreach($types as $type) {
          BussinessType::updateOrCreate(['name' => $type]);
        }
    }
}
