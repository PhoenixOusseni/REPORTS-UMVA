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
                'nom' => 'Super',
                'prenom' => 'User',
                'umva_id' => 'superuser.bf',
                'password' => Hash::make('password'),
                'sexe' => 'Homme',
                'role_id' => 1,
            ],
        ]);
    }
}
