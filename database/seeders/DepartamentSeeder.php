<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
			['name' => 'INTELIGENCIA TECNOLOGICA'],
			['name' => 'IT DATA'],
            ['name' => 'DAF'],
			['name' => 'ENERGY'],
            ['name' => 'PRINT'],
			['name' => 'BCX'],
            ['name' => 'MARKETING'],
			['name' => 'COMERCIAL'],
		]);
    }
}
