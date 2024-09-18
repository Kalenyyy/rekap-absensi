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
            'email' => "admin@gmail.com",
            'username' => "admin",
            'role' => 'admin',
            "password" => Hash::make("admin"),
            "status" => 'online',
            //cara lain ekpripsi : bcyrpt


        ]);
    }
}
