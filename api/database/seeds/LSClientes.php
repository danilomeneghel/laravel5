<?php

use Illuminate\Database\Seeder;

class LSClientes extends Seeder
{
    
    public function run()
    {
        DB::table('ls_clientes')->update(array(
            'ls_fontes_id' => 1
        ));
    }
}
