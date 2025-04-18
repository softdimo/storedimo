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
        Schema::table('compras', function (Blueprint $table) {
            // Quitamos la relación vieja
            $table->dropForeign(['id_proveedor']);

            // Creamos la nueva relación correcta
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
             // Quitamos la nueva relación
             $table->dropForeign(['id_proveedor']);

             // Restauramos la relación anterior
             $table->foreign('id_proveedor')->references('id_persona')->on('personas');
        });
    }
};
