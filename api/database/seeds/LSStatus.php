<?php

use Illuminate\Database\Seeder;

class LSStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_status CASCADE");
        
        $data = [
            [
                'id'=>1,
                'nome'=>'pedido_criado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                
                'nome'=>'pendente_pagamento',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'nome'=>'pagamento_autorizado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>4,
                'nome'=>'completo',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>5,
                'nome'=>'fechado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>6,
                'nome'=>'cancelado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>7,
                'nome'=>'pausado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>8,
                'nome'=>'enviado',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>9,
                'nome'=>'preparando_envio',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>10,
                'nome'=>'entregue',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ]
        ];
        
        DB::table('ls_status')->insert($data);
    }
}
