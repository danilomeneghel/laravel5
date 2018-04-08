<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLsProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_produtos', function (Blueprint $table) {
            $table->string('link')->nullable()->create();
            $table->string('versao')->nullable()->create();
            $table->text('descricao')->nullable()->create();
            $table->text('parametros_robo')->nullable()->create();
            $table->timestamp('disabled_at')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ls_produtos', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('versao');
            $table->dropColumn('descricao');
            $table->dropColumn('parametros_robo');
            $table->dropColumn('disabled_at');
        });
    }
}
