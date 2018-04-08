<?php

/*
 * This file is part of OAuth 2.0 Laravel.
 *
 * (c) Luca Degasperi <packages@lucadegasperi.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This is the create oauth sessions table migration class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class UpdateOauthSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            DB::statement('ALTER TABLE oauth_sessions DROP CONSTRAINT oauth_sessions_owner_type_check;');
            DB::statement('ALTER TABLE oauth_sessions ADD CONSTRAINT oauth_sessions_owner_type_check CHECK (owner_type::TEXT = ANY (ARRAY[\'admin\'::CHARACTER VARYING, \'user\'::CHARACTER VARYING, \'client\'::CHARACTER VARYING]::TEXT[]))');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            //DB::statement("ALTER TABLE oauth_sessions ALTER COLUMN owner_type owner_type ENUM('admin', 'user', 'client')");        
    }
}
