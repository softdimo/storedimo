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
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');
            $table->date('fecha_compra')->nullable();
            $table->string('valor_compra')->nullable();
            $table->unsignedInteger('id_proveedor')->nullable();
            $table->unsignedInteger('id_usuario')->nullable();
            $table->unsignedInteger('id_estado')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_proveedor')->references('id_persona')->on('personas');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_estado')->references('id_estado')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
