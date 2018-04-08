<?php

use Illuminate\Database\Seeder;

class LSAplicacoesDescontos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_aplicacoes_descontos CASCADE");
        
        $data = [
            [
                'id'=>1,
                'ls_fontes_id'=>1,
                'nome'=>'produto',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                'ls_fontes_id'=>1,
                'nome'=>'categoria_produto',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'ls_fontes_id'=>1,
                'nome'=>'Tudo',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>4,
                'ls_fontes_id'=>1,
                'nome'=>'Tudo, menos produtos que sejam pacotes',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],


        ];

        DB::table('ls_aplicacoes_descontos')->insert($data);
    }
}
