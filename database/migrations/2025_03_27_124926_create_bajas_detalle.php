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
        Schema::create('bajas_detalle', function (Blueprint $table) {
            $table->increments('id_baja_detalle');
            $table->unsignedInteger('id_baja')->nullable();
            $table->unsignedInteger('id_tipo_baja')->nullable();
            $table->unsignedInteger('id_producto')->nullable();
            $table->string('cantidad')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_baja')->references('id_baja')->on('bajas')->onDelete('cascade');
            $table->foreign('id_tipo_baja')->references('id_tipo_baja')->on('tipo_baja')->onDelete('cascade');
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
        Schema::dropIfExists('bajas_detalle');
    }
};
