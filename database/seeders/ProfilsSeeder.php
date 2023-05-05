<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profil::create([
            'profilLibelle' => 'Admin'
        ]);

        Profil::create([
            'profilLibelle' => 'Influenceur'
        ]);

        Profil::create([
            'profilLibelle' => 'Client'
        ]);
    }
}
