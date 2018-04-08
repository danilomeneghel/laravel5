<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertOauthScopeAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $scope = [
            ['id' => 'admin','description' => 'Escopo de administrador','created_at' => new DateTime,'updated_at' => new DateTime]
        ];
        DB::table('oauth_scopes')->insert($scope);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_scopes', function (Blueprint $table) {
            //
        });
    }
}
