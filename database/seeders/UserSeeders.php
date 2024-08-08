<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            //colum table db => value
            'id_user' => "1",
            'username' => "admin@gmail.com",
            'role' => 1,
            "password" => Hash::make("admin"),
            //cara lain ekpripsi : bcyrpt


        ]);
        User::create([
            'id_user' => "2",
            'username' => "guru@gmail.com",
            'role' => 2,
            "password" => Hash::make("guru"),


        ]);
    }
}
