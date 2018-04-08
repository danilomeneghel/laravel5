<?php

use Illuminate\Database\Seeder;

class LSCategoriasProdutos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement("TRUNCATE TABLE ls_categorias_produtos CASCADE");
        
        $data = [
            [
                'id'=>9999,
                'ls_fontes_id'=>1,
                'nome'=>'curso',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>9989,
                'ls_fontes_id'=>2,
                'nome'=>'assinatura',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ],
            [
                'id'=>9987,
                'ls_fontes_id'=>2,
                'nome'=>'curso',
                'created_at'=>new Datetime,
                'updated_at'=>new Datetime
            ]
        ];

        DB::table('ls_categorias_produtos')->insert($data);

    }
}
