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
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id_venta');
            $table->dateTime('fecha_venta')->nullable();
            $table->string('descuento')->nullable();
            $table->string('subtotal_venta')->nullable();
            $table->string('total_venta')->nullable();
            $table->unsignedInteger('id_tipo_pago')->nullable();
            $table->unsignedInteger('id_producto')->nullable();
            $table->unsignedInteger('id_cliente')->nullable();
            $table->unsignedInteger('id_usuario')->nullable();
            $table->unsignedInteger('id_estado')->nullable();
            $table->unsignedInteger('id_estado_credito')->nullable();
            $table->date('fecha_limite_credito')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_tipo_pago')->references('id_tipo_pago')->on('tipos_pago');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->foreign('id_cliente')->references('id_persona')->on('personas');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_estado')->references('id_estado')->on('estados');
            $table->foreign('id_estado_credito')->references('id_estado_credito')->on('estados_credito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
