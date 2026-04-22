<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('belanja', function (Blueprint $table) {
            $table->decimal('realisasi_belanja', 15, 2)
                ->default(0)
                ->after('pagu');
        });
    }

    public function down()
    {
        Schema::table('belanja', function (Blueprint $table) {
            $table->dropColumn('realisasi_belanja');
        });
    }
};
