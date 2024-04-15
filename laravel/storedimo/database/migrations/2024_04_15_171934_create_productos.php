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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->string('nombre_producto')->nullable();
            $table->unsignedInteger('id_categoria')->nullable();
            $table->integer('precio_unitario')->nullable();
            $table->integer('precio_detal')->nullable();
            $table->integer('precio_por_mayor')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('stock_minimo')->nullable();
            $table->unsignedInteger('estado')->nullable();
            $table->string('tamano')->nullable();
            $table->integer('cantidad')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
