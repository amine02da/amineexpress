<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Category::factory(5)->create();
        // \App\Models\Store::factory(5)->create();
        // \App\Models\Product::factory(100)->create();

        \App\Models\Admin::create([
            "name" => "amine",
            "email" => "amineexpress@gmail.com",
            "username" => "amineexpress",
            "password" => Hash::make("aminedaaboub"),
            "phone_number" => "0659540718",
            "super_admin" => 0,
            "status" => "active"
        ]);
        // $this->call(UserSeeder::class);
    }
}
