<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsDatasCadastros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_datas_cadastros', function(Blueprint $table){
            
            $table->increments('id');
            $table->integer('ls_clientes_id');
            $table->foreign('ls_clientes_id')
                  ->references('id')->on('ls_clientes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->integer('ls_fontes_id');
            $table->foreign('ls_fontes_id')
                  ->references('id')->on('ls_clientes')
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
        Schema::drop('ls_datas_cadastros');
    }
}
