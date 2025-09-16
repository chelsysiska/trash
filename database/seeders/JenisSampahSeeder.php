<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_sampah')->insert([
    ['nama_sampah' => 'Plastik', 'harga_per_kg' => 2000],
    ['nama_sampah' => 'Kertas', 'harga_per_kg' => 1500],
    ['nama_sampah' => 'Logam', 'harga_per_kg' => 5000],
    ['nama_sampah' => 'Kaca', 'harga_per_kg' => 2500],
]);
    }
}
