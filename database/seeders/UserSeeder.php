<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::create([
            "name" => "amine",
            "email" => "daaboub.am@gmail.com",
            "password" => Hash::make("aminedaaboub")
        ]);
        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin")
        ]);
        User::create([
            "name" => "Davendor",
            "email" => "Davendor@gmail.com",
            "password" => Hash::make("aminedaaboub")
        ]);
        User::create([
            "name" => "superAdmin",
            "email" => "superadmin@gmail.com",
            "password" => Hash::make("aminedaaboub")
        ]);
    }
}
