<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(50)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

        // DB::table('contacts')->insert([
        //     'name' => '',
        //     'email' => '',
        //     'phone' => '',
        //     'whatsapp' => '',
        //     'facebook' => '',
        //     'twitter' => '',
        //     'instagram' => '',
        // ]);

        // DB::table('users')->insert([
        //     'id'=>1,
        //     'name' => 'admin',
        //     'email' => 'admin@alraqy.com',
        //     'password' => bcrypt('12345678'),
        //     'is_admin' => true,
        //     'is_active' => true
        // ]);

        $this->call([
            // CarSeeder::class
            
        ]);
    }
}
