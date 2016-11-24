<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('empleados/cargo', 'CargoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
Route::resource('localizaciones/grupodepartamento', 'GrupoDepartamentoController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
Route::resource('localizaciones/departamento', 'DepartamentoController', ['only' => ['index', 'create',  'edit','store', 'update', 'destroy', 'show']]);
Route::resource('localizaciones/grupolocalizacion', 'GrupoLocalizacionController', ['only' => ['index', 'edit', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('localizaciones/localizacion', 'LocalizacionController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
Route::resource('empleados/empleado', 'EmpleadoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('supervisorempleado', 'SupervisorEmpleadoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);


Route::get('/', function () {
    return view('auth/login');
});


Route::auth();

Route::get('/home', 'HomeController@index');

/*
Route::get('api/grupodepartamento', function() {
	return Datatables::eloquent(grupodepartamento::query())->make(true);
});
*/