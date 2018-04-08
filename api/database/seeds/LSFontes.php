<?php

use Illuminate\Database\Seeder;

class LSFontes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::statement("TRUNCATE TABLE ls_fontes CASCADE");
        
        $fontes = [
            [
                'id'=>1,
                'nome'=>'site_novo',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>2,
                'nome'=>'site_antigo',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>3,
                'nome'=>'xp_investimentos',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ]
        ];*/
        
        $fontes = [
            [
                'id'=>4,
                'nome'=>'L&S Investimentos Imobiliários',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>5,
                'nome'=>'L&S Capital',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>6,
                'nome'=>'L&S Análise',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>7,
                'nome'=>'L&S Global',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>8,
                'nome'=>'L&S Quant',
                'descricao'=>'n/a',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ]
        ];
        
        DB::table('ls_fontes')->insert($fontes);
    }
}
