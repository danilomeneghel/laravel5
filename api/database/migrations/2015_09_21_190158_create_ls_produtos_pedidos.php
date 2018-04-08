<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsProdutosPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_produtos_pedidos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_produtos_id');
            $table->foreign('ls_produtos_id')
                  ->references('id')->on('ls_produtos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_pedidos_id');
            $table->foreign('ls_pedidos_id')
                  ->references('id')->on('ls_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
             $table->decimal('preco',10,2)->nullable();
             $table->integer('quantidade')->nullable();
             $table->timestamp('inicio_assinatura')->nullable(); 
             $table->timestamp('fim_assinatura')->nullable();
          
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
        Schema::drop('ls_produtos_pedidos');
    }
}
