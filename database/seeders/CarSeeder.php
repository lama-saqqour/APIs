<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create(
            [
                'name' => 'كامري/سوناتا 2024',
                'persons' => 3,
                'bags' => 3,
                'image' => 'car.jpg',
            ],
        );

        Car::create(

            [
                'name' => 'فورد توريس 2024',
                'category_id' => 2,
                'persons' => 3,
                'bags' => 3,
                'image' => 'car.jpg',
            ],

        );
        Car::create(
            [
                'name' => 'جمس يوكن اكس ال 2024',
                'category_id' => 3,
                'persons' => 7,
                'bags' => 7,
                'image' => 'car.jpg',
            ],

        );
        Car::create(
            [
                'name' => 'اتش ون 2024',
                'category_id' => 3,
                'persons' => 11,
                'bags' => 11,
                'image' => 'car.jpg',
            ],

        );
        Car::create(
            [
                'name' => 'مرسيدس s560 2023',
                'category_id' => 4,
                'persons' => 3,
                'bags' => 3,
                'image' => 'car.jpg',
            ],
        );
    }
}
