<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('belanja', function (Blueprint $table) {

            $table->string('pajak')
                  ->nullable()
                  ->after('realisasi_belanja');

        });
    }

    public function down(): void
    {
        Schema::table('belanja', function (Blueprint $table) {

            $table->dropColumn('pajak');

        });
    }
};