<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('ls_clientes', function (Blueprint $table){

            $table->increments('id');
            $table->string('nome',255)->nullable();
            $table->string('sexo',1)->nullable(); 
            $table->timestamp('data_nascimento')->nullable();
            $table->string('cpf_cnpj',14)->nullable();
            $table->string('senha', 50)->nullable();
            $table->integer('codigo_origem_cliente')->nullable();
            $table->integer('codigo_origem_cliente_xp')->nullable();
            $table->integer('codigo_origem_cliente_antigo')->nullable();
            $table->decimal('net',10,2)->nullable();
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
        Schema::drop('ls_clientes');
    }
}