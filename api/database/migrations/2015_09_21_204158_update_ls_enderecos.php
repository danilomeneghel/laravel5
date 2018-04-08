<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLsEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_enderecos', function (Blueprint $table) {
            $table->integer('ls_fontes_id')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ls_enderecos', function (Blueprint $table) {
            $table->integer('ls_fontes_id')->change();
        });
    }
}
