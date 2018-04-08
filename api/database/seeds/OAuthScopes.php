<?php

use Illuminate\Database\Seeder;

class OAuthScopes extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::statement("TRUNCATE TABLE oauth_scopes CASCADE");
        
        DB::table('oauth_scopes')->insert([
            'id'        => 'LSPainel',
            'description' => 'Escopo do Painel LS',
            'created_at'=>new Datetime,
            'updated_at'=>new Datetime
        ]);
        
        DB::table('oauth_scopes')->insert([
            'id'        => 'LSSite',
            'description' => 'Escopo do Site LS',
            'created_at'=>new Datetime,
            'updated_at'=>new Datetime
        ]);
    }
}
