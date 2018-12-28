<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Validator::extendImplicit('current_password', function($attribute, $value, $parameters, $validator)
        {
            return \Hash::check($value, auth()->user()->password);
        });


        // \Validator::extendImplicit('email', function($attribute, $value, $parameters, $validator)
        // {
        //     return  Rule::unique('users')->ignore(auth()->user()->id);
        // });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
