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
        Schema::create('realisasi_pendapatan', function (Blueprint $table) {
            $table->id();

            // RELASI KE PENDAPATAN
            $table->foreignId('pendapatan_id')
                ->constrained('pendapatan')
                ->onDelete('cascade');

            $table->bigInteger('realisasi')->default(0);
            $table->bigInteger('sisa')->default(0);
            $table->float('persentase')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_pendapatan');
    }
};
