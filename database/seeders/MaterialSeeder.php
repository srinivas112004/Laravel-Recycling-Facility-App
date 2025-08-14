<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Computers','Smartphones','Lithium-ion Batteries','AA Batteries',
            'Plastic','Glass','Cardboard','Aluminum','Steel','E-waste',
        ];
        foreach ($items as $name) {
            Material::firstOrCreate(['name' => $name]);
        }
    }
}
