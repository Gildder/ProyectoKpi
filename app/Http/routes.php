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

Route::resource('grdepartamento', 'GrupoDepartamentoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('departamento', 'DepartamentoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('grlocalizacion', 'GrupoLocalizacionController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('localizacion', 'LocalizacionController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('empleado', 'EmpleadoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('proyecto', 'ProyectoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('tarea', 'TareaController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::resource('tarealocal', 'TareaLocalizacionController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
