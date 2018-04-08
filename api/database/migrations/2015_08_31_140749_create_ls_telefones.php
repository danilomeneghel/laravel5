<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_telefones', function (Blueprint $table){

            $table->increments('id');
            $table->string('telefone',255);
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
            $table->timestamp('disabled_at')->nullable(); 
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
        Schema::drop('ls_telefones');
    }
}
