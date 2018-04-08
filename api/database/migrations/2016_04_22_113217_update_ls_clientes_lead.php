<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLsClientesLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ls_clientes_lead', function (Blueprint $table) {
            $table->date('data_nascimento')->nullable()->change();
            $table->string('ls_clientes_id')->nullable()->create();
            $table->string('ls_parceiros_id')->nullable()->create();
            $table->string('telefone')->nullable()->create();
            $table->dropColumn('fone');
            $table->dropColumn('celular');
            $table->dropColumn('senha');
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
        Schema::table('ls_clientes_lead', function (Blueprint $table) {
            $table->dropColumn('data_nascimento');
            $table->dropColumn('ls_clientes_id');
            $table->dropColumn('ls_parceiros_id');
            $table->dropColumn('telefone');
            $table->dropColumn('fone');
            $table->dropColumn('celular');
            $table->dropColumn('senha');
            $table->dropColumn('disabled_at');
        });
    }
}
