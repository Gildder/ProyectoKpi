<?php

namespace ProyectoKpi\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('before_equal', function($attribute, $value, $parameters, $validator) {
            $fechaFin = $validator->getData()[$parameters[0]];
            if($fechaFin >= $value){
                return true;
            }else{
                return false;
            }
        });

        Validator::extend('after_equal', function($attribute, $value, $parameters,$validator) {
            $fechaInicio = $validator->getData()[$parameters[0]];
            if($fechaInicio <= $value){
                return true;
            }else{
                return false;
            }
        });
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
