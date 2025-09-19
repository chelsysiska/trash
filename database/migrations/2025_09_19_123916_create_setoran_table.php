<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setoran', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('nasabah_id'); // relasi ke nasabah
        $table->date('tanggal');
        $table->string('jenis_sampah');
        $table->decimal('berat', 8, 2); // kg
        $table->decimal('harga_per_kg', 10, 2);
        $table->decimal('total_harga', 12, 2);
        $table->timestamps();

        $table->foreign('nasabah_id')->references('id')->on('nasabah')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
