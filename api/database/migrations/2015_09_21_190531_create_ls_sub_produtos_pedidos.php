<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsSubProdutosPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ls_sub_produtos_pedidos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_produtos_pedidos_id');
            $table->foreign('ls_produtos_pedidos_id')
                  ->references('id')->on('ls_produtos_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_produtos_id');
            $table->foreign('ls_produtos_id')
                  ->references('id')->on('ls_produtos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->decimal('preco',10,2)->nullable();
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

         Schema::drop('ls_sub_produtos_pedidos');
        
    }
}
