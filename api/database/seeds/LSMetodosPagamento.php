<?php

use Illuminate\Database\Seeder;

class LSMetodosPagamento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_metodos_pagamentos CASCADE");
        
        $metodos_pagamentos = [
            [
                'id'=>1,
                'nome'=>'Boleto',
                'created_at'=> new Datetime,
                'updated_at'=> new Datetime
            ],
            [
                'id'=>2,
                'nome'=>'Cartão de crédito',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'nome'=>'Transferência',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>5,
                'nome'=>'Nenhum',
                'created_at'=> new Datetime,
                'updated_at'=> new Datetime
            ]
        ];
        
        DB::table('ls_metodos_pagamentos')->insert($metodos_pagamentos);
    }
}
