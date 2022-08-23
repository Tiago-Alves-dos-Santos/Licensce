<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_sistemas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_empresa', 255)->nullable();
            $table->string('razao_social', 255)->nullable();
            $table->string('cpf', 255)->nullable();
            $table->string('cnpj', 255)->nullable();
            $table->string('rua', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->integer('numero')->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('estado', 255)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
        DB::statement("ALTER TABLE config_sistemas ADD logo MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_sistemas');
    }
};
