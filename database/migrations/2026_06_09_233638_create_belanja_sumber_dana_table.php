<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('belanja_sumber_dana', function (Blueprint $table) {

            $table->id();

            $table->foreignId('belanja_id')
                ->constrained('belanja')
                ->cascadeOnDelete();

            $table->foreignId('sumber_dana_id')
                ->constrained('sumber_dana')
                ->cascadeOnDelete();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('belanja_sumber_dana');
    }
};