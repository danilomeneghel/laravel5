<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call(LSFontes::class);
        $this->call(LSClientes::class);
        
        $this->command->info('Tables seeded!');
    }

}
