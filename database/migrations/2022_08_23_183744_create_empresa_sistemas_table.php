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
        Schema::create('empresa_sistemas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('sistema_id')->unsigned();
            $table->enum('tipo_licenca', ['usuario', 'pc']);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //foreng keys
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('sistema_id')->references('id')->on('sistemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_sistemas');
    }
};
