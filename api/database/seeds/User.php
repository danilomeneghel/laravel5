<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    
    public function run()
    {
        DB::statement("TRUNCATE TABLE users CASCADE");
        
        DB::table('users')->insert(array(
            'name' => 'Administrador',
            'email' => 'adm@admin.com',
            'password' => bcrypt('admin'),
            'created_at' => new Datetime,
            'updated_at' => new Datetime,
            'type' => 'admin'
        ));
        
        DB::table('users')->insert(array(
            'name' => 'Usuário',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'created_at' => new Datetime,
            'updated_at' => new Datetime,
            'type' => 'user'
        ));
    }
}
