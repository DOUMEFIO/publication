<?php

namespace Database\Seeders;

use App\Models\TypeTache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FichierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            TypeTache::create([
                'libelle' => 'Texte'
            ]);

            TypeTache::create([
                'libelle' => 'Audio'
            ]);

            TypeTache::create([
                'libelle' => 'Vidéo'
            ]);

            TypeTache::create([
                'libelle' => 'Image'
            ]);
        }
    }
}
