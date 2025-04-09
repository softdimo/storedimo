<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['id_estado']);

            // Eliminar la columna
            $table->dropColumn('id_estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->unsignedInteger('id_estado')->nullable(); // O solo integer(), según tu schema
            $table->foreign('id_estado')->references('id_estado')->on('estados');
        });
    }
};
