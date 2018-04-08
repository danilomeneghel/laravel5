<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_clientes', function (Blueprint $table) {
            $table->string('email')->nullable()->create();
            $table->string('senha', 60)->change();
            $table->renameColumn('senha','password');
            $table->rememberToken()->create();
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
            //
        });
    }
}
