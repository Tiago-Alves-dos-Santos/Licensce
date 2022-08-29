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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nome', 255)->nullable();
            $table->string('razao_social', 255)->nullable();
            $table->string('cnpj', 255)->nullable();
            $table->string('cpf', 255)->nullable();
            $table->date('data_vencimento');
            $table->date('inicio_uso');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //foreng keys
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
