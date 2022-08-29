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
        Schema::create('despeza_sistemas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sistema_id')->unsigned();
            $table->string('nome', 255)->nullable();
            $table->double('valor',11,2)->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //foreng keys
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
        Schema::dropIfExists('despeza_sistemas');
    }
};
