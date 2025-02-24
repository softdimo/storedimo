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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->unsignedInteger('id_tipo_persona')->nullable()->after('id_usuario');
            $table->string('numero_telefono')->nullable()->after('identificacion');
            $table->string('celular')->nullable()->after('numero_telefono');
            $table->unsignedInteger('id_genero')->nullable()->after('celular');
            $table->string('direccion')->nullable()->after('email');
            $table->date('fecha_contrato')->nullable()->after('direccion');
            $table->date('fecha_terminacion_contrato')->nullable()->after('fecha_contrato');

            $table->foreign('id_tipo_persona')->references('id_tipo_persona')->on('tipo_persona');
            $table->foreign('id_genero')->references('id_genero')->on('generos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('id_tipo_persona');
            $table->dropColumn('numero_telefono');
            $table->dropColumn('celular');
            $table->dropColumn('id_genero');
            $table->dropColumn('direccion');
            $table->dropColumn('fecha_contrato');
            $table->dropColumn('fecha_terminacion_contrato');
        });
    }
};
