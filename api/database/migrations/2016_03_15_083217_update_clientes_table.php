<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_clientes', function (Blueprint $table) {
            $table->integer('ls_fontes_id')->nullable()->create();
            
            $table->foreign('ls_fontes_id')
                    ->references('id')->on('ls_fontes')
                    ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ls_clientes', function (Blueprint $table) {
            $table->dropColumn('ls_fontes_id');
        });
    }
}
