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
            // Eliminar la clave foránea antigua
            $table->dropForeign(['id_estado_credito']);

            // Crear la nueva clave foránea
            $table->foreign('id_estado_credito')->references('id_estado')->on('estados');
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
            // Eliminar la clave foránea nueva
            $table->dropForeign(['id_estado_credito']);

            // Restaurar la relación original
            $table->foreign('id_estado_credito')->references('id_estado_credito')->on('estados_credito');
        });
    }
};
