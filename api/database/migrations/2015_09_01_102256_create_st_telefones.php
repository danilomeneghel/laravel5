<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('st_telefones', function(Blueprint $table){

            $table->increments('id');

            $table->integer('st_clientes_id');
            $table->foreign('st_clientes_id')
                  ->references('id')->on('st_clientes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_fontes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->string('telefone', 255)->nullable();
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
        Schema::drop('st_telefones');
    }
}
