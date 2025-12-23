<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nom' => 'OUEDRAOGO',
                'prenom' => 'Ousseni',
                'umva_id' => 'superuser.bf',
                'email' => 'superuser.bf@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'nom' => 'DIALLO',
                'prenom' => 'Aminata',
                'umva_id' => 'ka.kaya',
                'email' => 'ka@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'nom' => 'TRAORE',
                'prenom' => 'Moussa',
                'umva_id' => 'ma.sanmatenga',
                'email' => 'ma@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
            ],
            [
                'nom' => 'COULIBALY',
                'prenom' => 'Fatoumata',
                'umva_id' => 'pf.centre-nord',
                'email' => 'fp@example.com',
                'password' => Hash::make('password'),
                'role_id' => 4,
            ],
        ]);
    }
}
