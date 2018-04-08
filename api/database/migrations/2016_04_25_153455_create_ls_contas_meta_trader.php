<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsContasMetaTrader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_contas_meta_trader', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ls_clientes_id');
            $table->foreign('ls_clientes_id')
                  ->references('id')->on('ls_clientes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->string('nome', 255);
            $table->integer('conta_real');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ls_contas_meta_trader');
    }
}
