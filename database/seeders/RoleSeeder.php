<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'libelle' => 'super user',
                'description' => 'Utilisateur avec tous les droits',
            ],
            [
                'libelle' => 'KA',
                'description' => 'Administrateur de la KA',
            ],
            [
                'libelle' => 'MA',
                'description' => 'Membre de la MA',
            ],
            [
                'libelle' => 'FP',
                'description' => 'Fournisseur de la FP',
            ],
        ]);
    }
}
