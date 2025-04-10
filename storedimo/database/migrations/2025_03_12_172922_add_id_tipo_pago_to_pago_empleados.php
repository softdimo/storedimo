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
            $table->unsignedInteger('id_tipo_pago')->nullable()->after('id_pago_empleado');

            $table->foreign('id_tipo_pago')->references('id_tipo_pago')->on('tipos_pago');
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
            $table->dropColumn('id_tipo_pago');
        });
    }
};
