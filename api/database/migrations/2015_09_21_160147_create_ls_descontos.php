<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsDescontos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ls_descontos', function(Blueprint $table){

            $table->increments('id');

            $table->integer('ls_aplicacoes_descontos_id');
            $table->foreign('ls_aplicacoes_descontos_id')
                  ->references('id')->on('ls_aplicacoes_descontos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_tipos_descontos_id');
            $table->foreign('ls_tipos_descontos_id')
                  ->references('id')->on('ls_tipos_descontos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('qtde_usos_permitidos')->nullable();
            $table->string('proporcao')->nullable();
            $table->decimal('desconto',10,2)->nullable();
            $table->string('nome', 255)->nullable();
            $table->timestamp('inicio')->nullable();
            $table->timestamp('fim')->nullable();
          
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
        Schema::drop('ls_descontos');
    }
}
