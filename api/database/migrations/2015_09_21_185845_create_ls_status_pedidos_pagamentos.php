<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsStatusPedidosPagamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_status_pedidos_pagamentos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_pagamentos_id')->nullable();
            $table->foreign('ls_pagamentos_id')
                  ->references('id')->on('ls_pagamentos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_pedidos_id');
            $table->foreign('ls_pedidos_id')
                  ->references('id')->on('ls_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_status_id');
            $table->foreign('ls_status_id')
                  ->references('id')->on('ls_status')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
                  
            $table->string('descricao',255)->nullable();
          
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
         Schema::drop('ls_status_pedidos_pagamentos');
    }
}
