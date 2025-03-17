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
        Schema::table('pago_empleados', function (Blueprint $table) {
            $table->unsignedInteger('id_empresa')->nullable()->after('id_pago_empleado');

            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pago_empleados', function (Blueprint $table) {
            $table->dropColumn('id_pago_empleado');
        });
    }
};
