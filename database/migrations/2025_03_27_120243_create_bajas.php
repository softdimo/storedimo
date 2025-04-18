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
        Schema::create('bajas', function (Blueprint $table) {
            $table->increments('id_baja');
            $table->unsignedInteger('id_responsable_baja')->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->unsignedInteger('id_estado_baja')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_responsable_baja')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_estado_baja')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bajas');
    }
};
