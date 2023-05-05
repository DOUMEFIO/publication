<?php

namespace Database\Seeders;

use App\Models\CentreInteret;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            CentreInteret::create([
                'libelle' => 'Nouriture'
            ]);

            CentreInteret::create([
                'libelle' => 'Restaurant'
            ]);

            CentreInteret::create([
                'libelle' => 'Marche'
            ]);

            CentreInteret::create([
                'libelle' => 'Vente'
            ]);
        }
    }
}
