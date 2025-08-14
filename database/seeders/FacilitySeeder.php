<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\Material;
use Illuminate\Support\Carbon;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'business_name' => 'Green Earth Recyclers',
                'last_update_date' => Carbon::parse('2023-11-04'),
                'street_address' => '123 5th Ave, New York, NY 10001',
                'materials' => ['Computers','Smartphones','Lithium-ion Batteries','AA Batteries'],
            ],
            [
                'business_name' => 'Eco City Materials',
                'last_update_date' => Carbon::parse('2024-02-18'),
                'street_address' => '200 Market St, San Francisco, CA 94103',
                'materials' => ['Glass','Plastic','Cardboard','Aluminum'],
            ],
            [
                'business_name' => 'Urban E-Waste Solutions',
                'last_update_date' => Carbon::parse('2024-07-09'),
                'street_address' => '55 Lake Shore Dr, Chicago, IL 60601',
                'materials' => ['E-waste','Computers','Steel'],
            ],
        ];

        foreach ($samples as $s) {
            $facility = Facility::firstOrCreate([
                'business_name' => $s['business_name'],
            ], [
                'last_update_date' => $s['last_update_date'],
                'street_address'   => $s['street_address'],
            ]);

            $materialIds = Material::whereIn('name', $s['materials'])->pluck('id');
            $facility->materials()->syncWithoutDetaching($materialIds);
        }
    }
}
