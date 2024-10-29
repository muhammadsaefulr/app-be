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
        Schema::create('kontak_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('no_hp');
            $table->string('email');
            $table->string('npwp');

            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_pegawais');
    }
};
