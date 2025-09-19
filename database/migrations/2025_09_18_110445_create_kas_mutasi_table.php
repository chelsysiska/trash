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
        Schema::create('kas_mutasi', function (Blueprint $table) {
            $table->increments('id_mutasi');
            $table->unsignedInteger('id_transaksi')->nullable();
            $table->decimal('nominal', 12, 2);
            $table->enum('tipe', ['debit','kredit']); // debit = uang masuk
            $table->string('keterangan')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_mutasi');
    }
};
