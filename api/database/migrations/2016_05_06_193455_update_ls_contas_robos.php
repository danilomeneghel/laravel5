<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLsContasRobos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_contas_robos', function (Blueprint $table) {
            $table->date('permissao_demo')->nullable()->create();
            $table->date('permissao_real')->nullable()->create();
            $table->dropColumn('status');
            $table->dropColumn('disabled_at');
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
