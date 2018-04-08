<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_clientes', function (Blueprint $table) {
            $table->date('data_nascimento')->nullable()->change();
            $table->string('username')->nullable()->create();
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
            $table->dropColumn('data_nascimento');
            $table->dropColumn('username');
        });
    }
}
