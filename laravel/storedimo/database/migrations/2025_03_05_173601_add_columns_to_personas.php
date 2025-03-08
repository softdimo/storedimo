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
        Schema::table('personas', function (Blueprint $table) {
            $table->string('nit_empresa')->nullable()->after('id_estado');
            $table->string('nombre_empresa')->nullable()->after('nit_empresa');
            $table->string('telefono_empresa')->nullable()->after('nombre_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('nit_empresa');
            $table->dropColumn('nombre_empresa');
            $table->dropColumn('telefono_empresa');
        });
    }
};
