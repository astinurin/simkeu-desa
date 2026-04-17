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
        Schema::create('realisasi_belanja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('belanja_id')->unique()->constrained('belanja')->onDelete('cascade');

            $table->bigInteger('realisasi');
            $table->bigInteger('sisa');
            $table->float('persentase');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_belanja');
    }
};
