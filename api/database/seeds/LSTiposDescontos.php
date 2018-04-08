<?php

use Illuminate\Database\Seeder;

class LSTiposDescontos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_tipos_descontos CASCADE");
        
        $data = [
            [
                'id'=>1,
                'ls_fontes_id'=>1,
                'nome'=>'cupom',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                'ls_fontes_id'=>1,
                'nome'=>'metodo_pagamento',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ]
        ];
        
        DB::table('ls_tipos_descontos')->insert($data);
    }
}
