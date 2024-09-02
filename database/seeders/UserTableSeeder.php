<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Encontre a empresa à qual o usuário será associado
        // $company = Companies::where('name', 'Total Energies')->first();

        // Encontre as empresas às quais os usuários serão associados
        $totalEnergies = Companies::where('name', 'Total Energies')->first();
        $pumangol = Companies::where('name', 'Pumangol')->first();


        // Crie o usuário
        $user1 = User::create([
            'name'     => 'Armando Quinanga',
            'email'    => 'armando.quinanga@rcsangola.com',
            'password' => Hash::make('12345678'),
            'company_id' => $totalEnergies->id, // Associa o usuário à empresa
        ]);

        // Atribua os papéis ao usuário
        // Certifique-se de que os papéis já existam no banco de dados
        $roles = ['Super', 'Admin']; // Substitua pelos papéis que deseja atribuir

        $user1->syncRoles($roles);

        $this->command->info('User created successfully with roles');

        // Crie o usuário para a empresa Pumangol
        $user2 = User::create([
            'name'       => 'João Silva',
            'email'      => 'joao.silva@pumangol.com',
            'password'   => Hash::make('12345678'),
            'company_id' => $pumangol->id, // Associa o usuário à empresa Pumangol
        ]);

        // Atribua os papéis ao segundo usuário
        $user2->syncRoles($roles);

        $this->command->info('User for Pumangol created successfully with roles');
    }
}
