<?php

use Illuminate\Database\Seeder;

class LSDescontos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE ls_descontos CASCADE");
        
        $data = [
            [
                'id'=>1,
                'ls_aplicacoes_descontos_id'=>3,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>2,
                'desconto'=>10.00,
                'nome'=>'boleto',
                'inicio'=> new Datetime('2000-01-01'),
                'fim'=> new Datetime('3000-01-01'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'inteiro',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                'ls_aplicacoes_descontos_id'=>3,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>2,
                'desconto'=>5.00,
                'nome'=>'credito',
                'inicio'=>new Datetime('2000-01-01'),
                'fim'=>new Datetime('3000-01-01'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>5.00,
                'nome'=>'monte_pacote_5',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>4,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>10.00,
                'nome'=>'monte_pacote_10',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

            [
                'id'=>5,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>20.00,
                'nome'=>'monte_pacote_20',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

            [
                'id'=>6,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>40.00,
                'nome'=>'monte_pacote_40',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

            [
                'id'=>7,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>60.00,
                'nome'=>'monte_pacote_60',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

            [
                'id'=>8,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>80.00,
                'nome'=>'monte_pacote_80',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

            [
                'id'=>9,
                'ls_aplicacoes_descontos_id'=>4,
                'ls_fontes_id'=>1,
                'ls_tipos_descontos_id'=>1,
                'desconto'=>100.00,
                'nome'=>'produto gratuito',
                'inicio'=>new Datetime('2015-04-24'),
                'fim'=>new Datetime('2015-09-04'),
                'qtde_usos_permitidos'=>1000000000,
                'proporcao'=>'porcentagem',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],

        ];

        DB::table('ls_descontos')->insert($data);
        DB::statement("ALTER SEQUENCE ls_descontos_id_seq RESTART WITH 10");

    }
}
