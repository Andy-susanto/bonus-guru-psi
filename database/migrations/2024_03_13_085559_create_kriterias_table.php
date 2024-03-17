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
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_kriteria');
            $table->unsignedBigInteger('tipe_id');
            // $table->foreignId('tipe_id')->references('tipe')->on('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
