<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            User::create([
                'nom' => "Anne",
                'prenom' => "DOUMEFIO",
                'email' => "anne@gmail.com",
                'idProfil' => 1,
                'password' => Hash::make('azertyuiop'),
            ]);

            User::create([
                'nom' => "Arnaud",
                'prenom' => "LOKONON",
                'email' => "arnaud@gmail.com",
                'idProfil' => 1,
                'password' => Hash::make('azertyuiop'),
            ]);
        }
    }
}
