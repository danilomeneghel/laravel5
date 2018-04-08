<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsClientesLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_clientes_lead', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255)->nullable();
            $table->string('sexo',1)->nullable();
            $table->timestamp('data_nascimento')->nullable();
            $table->string('cpf_cnpj',14)->nullable();
            $table->string('senha', 50)->nullable();
            $table->string('email',255)->nullable();
            $table->string('fone',255)->nullable();
            $table->string('celular',255)->nullable();
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
        Schema::drop('ls_clientes_lead');
    }
}
