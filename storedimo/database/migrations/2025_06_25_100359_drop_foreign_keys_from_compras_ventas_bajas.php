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
        // Eliminar clave foránea en compras.id_usuario
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']); // compras_id_usuario_foreign
        });

        // Eliminar clave foránea en ventas.id_usuario
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']); // ventas_id_usuario_foreign
        });

        // Eliminar clave foránea en bajas.id_responsable_baja
        Schema::table('bajas', function (Blueprint $table) {
            $table->dropForeign(['id_responsable_baja']); // bajas_id_responsable_baja_foreign
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Restaurar clave foránea en compras.id_usuario
        Schema::table('compras', function (Blueprint $table) {
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // Restaurar clave foránea en ventas.id_usuario
        Schema::table('ventas', function (Blueprint $table) {
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // Restaurar clave foránea en bajas.id_responsable_baja
        Schema::table('bajas', function (Blueprint $table) {
            $table->foreign('id_responsable_baja')
                ->references('id_usuario')
                ->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }
};
