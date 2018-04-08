<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsDescontosCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

          Schema::create('ls_descontos_categorias', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_descontos_id');
            $table->foreign('ls_descontos_id')
                  ->references('id')->on('ls_descontos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_categorias_produtos_id');
            $table->foreign('ls_categorias_produtos_id')
                  ->references('id')->on('ls_categorias_produtos')
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

        Schema::drop('ls_descontos_categorias');
        
    }
}
