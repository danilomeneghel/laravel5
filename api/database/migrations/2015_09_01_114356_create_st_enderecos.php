<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_enderecos', function(Blueprint $table){

            $table->increments('id');
            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('st_clientes_id');
            $table->foreign('st_clientes_id')
                  ->references('id')->on('st_clientes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->string('cep',255)->nullable();
            $table->string('logradouro',255)->nullable();
            $table->string('complemento',255)->nullable();
            $table->string('cidade',255)->nullable();
            $table->string('uf',255)->nullable();
            $table->string('numero')->nullable();
            $table->string('pais',255)->nullable();
            $table->string('bairro',255)->nullable();
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
        Schema::drop('st_enderecos');
    }
}
