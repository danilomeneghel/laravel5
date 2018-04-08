<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsParceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_parceiros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable()->create();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ls_parceiros');
    }
}
