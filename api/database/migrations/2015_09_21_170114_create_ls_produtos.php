<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ls_produtos', function(Blueprint $table){

            $table->increments('id');
            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('codigo_origem_produto')->nullable();
            $table->string('nome', 255)->nullable();
            $table->decimal('preco',10,2)->nullable();
            $table->string('imagem', 255)->nullable();
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
          Schema::drop('ls_produtos');
    }
}
