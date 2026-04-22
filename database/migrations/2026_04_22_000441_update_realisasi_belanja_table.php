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
        Schema::table('realisasi_belanja', function (Blueprint $table) {

            // rename dulu
            $table->renameColumn('sisa', 'sisa_belanja');
        });

        Schema::table('realisasi_belanja', function (Blueprint $table) {

            $table->decimal('total_pagu_belanja', 15, 2)
                ->default(0)
                ->after('sisa_belanja');

            $table->decimal('total_sisa_belanja', 15, 2)
                ->default(0)
                ->after('total_pagu_belanja');

            $table->decimal('total_persentase', 5, 2)
                ->default(0)
                ->after('persentase');
        });
    }

    public function down()
    {
        Schema::table('realisasi_belanja', function (Blueprint $table) {

            $table->dropColumn([
                'total_pagu_belanja',
                'total_sisa_belanja',
                'total_persentase'
            ]);

            $table->renameColumn('sisa_belanja', 'sisa');
        });
    }
};
