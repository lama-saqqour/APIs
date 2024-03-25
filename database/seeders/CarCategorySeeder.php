<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars_categories')->insert([
            [
                'name' => 'اقتصادية'
            ],
            [
                'name' => 'VIP'
            ],
            [
                'name' => 'عائلية'
            ],
            [
                'name' => 'فاخرة'
            ],
        ]);
    }
}
