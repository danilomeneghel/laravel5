<?php

use Illuminate\Database\Seeder;

class OAuthClientTableSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::statement("TRUNCATE TABLE oauth_clients CASCADE");
        
        DB::table('oauth_clients')->insert([
            'id' => md5('m4kak0'),
            'secret' => 'secret',
            'name' => 'LSPainel',
            'created_at' => new Datetime,
            'updated_at' => new Datetime,
        ]);
    }
}
