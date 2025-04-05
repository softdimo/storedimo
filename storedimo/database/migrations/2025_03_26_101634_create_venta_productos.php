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
        Schema::create('venta_productos', function (Blueprint $table) {
            $table->increments('id_venta_producto');
            $table->unsignedInteger('id_venta')->nullable();
            $table->unsignedInteger('id_producto')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('precio_detal_venta')->nullable();
            $table->string('precio_x_mayor_venta')->nullable();
            $table->string('subtotal')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_productos');
    }
};
