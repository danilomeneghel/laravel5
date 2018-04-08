<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsPagamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('ls_pagamentos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_pedidos_id');
            $table->foreign('ls_pedidos_id')
                  ->references('id')->on('ls_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_metodos_pagamentos_id');
            $table->foreign('ls_metodos_pagamentos_id')
                  ->references('id')->on('ls_metodos_pagamentos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->string('transaction_hash',255)->nullable();
            $table->integer('qtde_parcelas')->nullable();
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
        Schema::drop('ls_pagamentos');
    }
}
