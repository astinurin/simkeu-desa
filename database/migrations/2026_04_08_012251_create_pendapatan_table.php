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
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id();

            // RELASI USER
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // DATA
            $table->string('kategori_pendapatan');
            $table->string('jenis_pendapatan');
            $table->bigInteger('pagu');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatan');
    }
};
