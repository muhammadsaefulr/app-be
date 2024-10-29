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
            Schema::create('unit_tugas', function (Blueprint $table) {
                $table->id();
                $table->string('nip')->unique();
                $table->string('gol');
                $table->string('eselon');
                $table->string('jabatan');
                $table->string('unit_kerja');
                $table->timestamps();
    
                $table->foreign('nip')->references('nip')->on('pegawai')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_tugas');
    }
};
