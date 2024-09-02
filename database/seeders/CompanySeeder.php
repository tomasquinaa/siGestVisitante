<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name'       => 'Total Energies',
                'address'    => 'Mutamba',
                'contact'    => '953652345',
                'logo_path'  => 'logos/1725265283.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Pumangol',
                'address'    => 'Talatona',
                'contact'    => '953652345',
                'logo_path'  => 'logos/1725265283.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Companies seeded successfully.');
    }
}
