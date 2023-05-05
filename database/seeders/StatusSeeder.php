<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            Status::create([
                'libelle' => 'Non Valide'
            ]);

            Status::create([
                'libelle' => 'Valide'
            ]);

            Status::create([
                'libelle' => 'En cours'
            ]);

            Status::create([
                'libelle' => 'soumis'
            ]);

            Status::create([
                'libelle' => 'Rejete'
            ]);
        }
    }
}
