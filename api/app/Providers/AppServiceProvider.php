<?php

namespace api\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

use api\Entities\LSEmails;
use api\Entities\LSLeads;
use api\Entities\User;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('email_exists', function($attribute, $value, $parameters) {
            return LSEmails::where( 'email', '=', $value )->get()->isEmpty();
        });
        Validator::extend('email_leads_exists', function($attribute, $value, $parameters) {
            return LSLeads::where( 'email', '=', $value )->get()->isEmpty();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserId', function ($app) {
            return Authorizer::getResourceOwnerId();
        });
        
        $this->app->singleton('UserType', function ($app) {
            return Authorizer::getResourceOwnerType();
        });
    }
}
