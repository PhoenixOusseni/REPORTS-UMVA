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
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            // [
            //     'nom' => 'DIALLO',
            //     'prenom' => 'Aminata',
            //     'umva_id' => 'ka.kaya',
            //     'password' => Hash::make('password'),
            //     'role_id' => 2,
            // ],
            // [
            //     'nom' => 'TRAORE',
            //     'prenom' => 'Moussa',
            //     'umva_id' => 'ma.sanmatenga',
            //     'password' => Hash::make('password'),
            //     'role_id' => 3,
            // ],
            // [
            //     'nom' => 'COULIBALY',
            //     'prenom' => 'Fatoumata',
            //     'umva_id' => 'pf.centre-nord',
            //     'password' => Hash::make('password'),
            //     'role_id' => 4,
            // ],
        ]);
    }
}
