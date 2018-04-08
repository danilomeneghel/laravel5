<?php

use Illuminate\Database\Seeder;

class LSPedidosCategorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_pedidos_categorias CASCADE");

        $data = [
            [
                'id'=>1,
                'nome'=>'loja',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                'nome'=>'cobranca_avulsa',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'nome'=>'assinatura',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>4,
                'nome'=>'curso',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
        ];

        DB::table('ls_pedidos_categorias')->insert($data);
    }
}
