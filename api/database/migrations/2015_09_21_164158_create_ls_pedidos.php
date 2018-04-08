<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ls_pedidos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_clientes_id');
            $table->foreign('ls_clientes_id')
                  ->references('id')->on('ls_clientes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_pedidos_categorias_id');
            $table->foreign('ls_pedidos_categorias_id')
                  ->references('id')->on('ls_pedidos_categorias')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('codigo_origem_pedido');
            $table->string('codigo_origem_pedido_hash', 255);
            $table->timestamp('vencimento')->nullable();
            $table->string('descricao',2000)->nullable();
            $table->decimal('total',20,2)->nullable();
            $table->decimal('sub_total',20,2)->nullable();

          
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
         Schema::drop('ls_pedidos');
    }
}
