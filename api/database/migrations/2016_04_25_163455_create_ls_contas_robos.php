<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsContasRobos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_contas_robos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ls_produtos_id');
            $table->foreign('ls_produtos_id')
                  ->references('id')->on('ls_produtos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->integer('ls_pedidos_id')->nullable();
            $table->foreign('ls_pedidos_id')
                  ->references('id')->on('ls_pedidos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->integer('ls_contas_meta_trader_id');
            $table->foreign('ls_contas_meta_trader_id')
                  ->references('id')->on('ls_contas_meta_trader')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->string('ativos', 255)->nullable();
            $table->timestamp('inicio_uso')->nullable()->create();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable()->create();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ls_contas_robos');
    }
}
