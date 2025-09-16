<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NasabahSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'), // password login: 12345678
                'role' => 'user', // role nasabah
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Nasabah',
                'email' => 'siti@test.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
