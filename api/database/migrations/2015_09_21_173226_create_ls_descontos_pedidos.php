<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsDescontosPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_descontos_pedidos', function(Blueprint $table){

            $table->increments('id');
            $table->string('desconto');
            $table->string('nome');
            $table->string('tipo');
            $table->string('proporcao');

            $table->integer('ls_pedidos_id');
            $table->foreign('ls_pedidos_id')
                  ->references('id')->on('ls_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
          
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
         Schema::drop('ls_descontos_pedidos');
    }
}
