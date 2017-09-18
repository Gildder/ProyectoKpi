<?php

namespace ProyectoKpi\Providers;

use DateTime;
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

            if(\Calcana::compararFechas($value, $fechaFin)<= 0){
                return true;
            }else{
                return false;
            }
        });

        Validator::extend('after_equal', function($attribute, $value, $parameters,$validator) {
            $fechaInicio = $validator->getData()[$parameters[0]];
            /**dd($fechaInicio, $value);*/
            if(\Calcana::compararFechas($fechaInicio, $value)<= 0){
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
