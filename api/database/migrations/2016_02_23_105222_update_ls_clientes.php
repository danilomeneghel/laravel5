<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLsClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_clientes', function (Blueprint $table) {
            $table->timestamp('lslive')->nullable()->create();
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
            $table->dropColumn('lslive');
        });
    }
}
