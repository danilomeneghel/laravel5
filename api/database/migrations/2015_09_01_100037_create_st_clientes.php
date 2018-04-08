<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_clientes', function(Blueprint $table){

            $table->increments('id');
            $table->integer('codigo_origem_cliente');

            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->string('nome',255)->nullable();
            $table->string('cpf_cnpj',14)->nullable();
            $table->string('sexo',1)->nullable();
            $table->integer('codigo_xpi')->nullable();
            $table->timestamp('data_nascimento')->nullable();
            $table->decimal('net',10,2)->nullable();
            $table->string('senha', 50)->nullable();
            $table->decimal('corretagem',10,2)->nullable();
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
        Schema::drop('st_clientes');
    }
}
