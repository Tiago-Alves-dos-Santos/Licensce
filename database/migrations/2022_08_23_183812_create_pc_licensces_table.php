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
        Schema::create('pc_licensces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empresa_id')->unsigned();
            $table->enum('logado', ['Y', 'N']);
            $table->text('chave_acesso')->nullable();
            $table->string('modelo', 255)->nullable();
            $table->text('indentificador')->nullable();
            $table->enum('valido', ['Y', 'N']);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //foreng keys
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_licensces');
    }
};
