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
            $table->unsignedInteger('id_periodo_pago')->nullable()->after('valor_comision');
            $table->unsignedInteger('salario_neto')->nullable()->after('valor_cesantias');

            $table->foreign('id_periodo_pago')->references('id_periodo_pago')->on('periodos_pago');
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
            $table->dropColumn('id_periodo_pago');
            $table->dropColumn('salario_neto');
        });
    }
};
