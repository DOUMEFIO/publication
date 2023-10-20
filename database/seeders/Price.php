<?php

namespace Database\Seeders;
use App\Models\ViewPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Price extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ViewPrice::create([
            'prixtache' => 2,
            'prixinfluenceur' =>0.9
        ]);
    }
}
