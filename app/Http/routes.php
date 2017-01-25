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

// **********************  MODULO EMPLEADOS  *****************************************
Route::resource('empleados/cargo', 'Empleados\CargoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

Route::get('empleados/cargo/indicadores/{cargo}', array('as' => 'empleados.cargo.indicadores', 'uses' => 'Empleados\CargoController@indicadores') );
Route::get('empleados/cargo/empleado/{cargo}', array('as' => 'empleados.cargo.empleado', 'uses' => 'Empleados\CargoController@empleado') );
Route::put('empleados/cargo/agregar/{cargo}', array('as' => 'empleados.cargo.agregar', 'uses' => 'Empleados\CargoController@agregar') );
Route::delete('empleados/cargo/quitar/{cargo}/{param?}', array('as' => 'empleados.cargo.quitar', 'uses' => 'Empleados\CargoController@quitar') );


//Empleado
Route::resource('empleados/empleado', 'Empleados\EmpleadoController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);

//Evaludor
Route::resource('empleados/evaluador', 'Empleados\EvaluadorController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

//Suprvisores
Route::resource('supervisorempleado', 'Empleados\SupervisorEmpleadoController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::get('supervisorempleado/departamentos/getDepartamentos', array('as' => 'supervisorempleado.departamentos.getDepartamentos', 'supervisores' =>  'Empleados\SupervisorEmpleadoController') );


// **********************  MODULO LOCALIZACIONES  *****************************************
Route::resource('localizaciones/grupodepartamento', 'Localizaciones\GrupoDepartamentoController', 
		['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);

Route::get('localizaciones/grupodepartamento/obtenerDepartamento/{id}', 'Localizaciones\GrupoDepartamentoController@getDepartamentos');

Route::resource('localizaciones/departamento', 'Localizaciones\DepartamentoController', 
		['only' => ['index', 'create',  'edit','store', 'update', 'destroy', 'show']]);


Route::resource('localizaciones/grupolocalizacion', 'Localizaciones\GrupoLocalizacionController', ['only' => ['index', 'edit', 'create', 'store', 'update', 'destroy', 'show']]);

Route::resource('localizaciones/localizacion', 'Localizaciones\LocalizacionController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy','show']]);


// **********************  MODULO INDICADORES *****************************************

Route::resource('indicadores/indicador', 'Indicadores\IndicadorController', 
		['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);

Route::post('indicadores/indicador/asign/{indicador}', array('as' => 'indicadores.indicador.asign', 'uses' => 'Indicadores\IndicadorController@asign') );

Route::get('indicadores/indicador/quitar/{indicador}/{param?}', array('as' => 'indicadores.indicador.quitar', 'uses' => 'Indicadores\IndicadorController@quitar') );

Route::resource('indicadores/primerindicador', 'Indicadores\PrimerIndicadorController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);


Route::resource('indicadores/indicadorcargo', 'Indicadores\IndicadorCargoController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);


// **********************  MODULO SUPERVIASORES *****************************************
Route::get('supervisores/departamentos/getdepartamentos', array('as' => 'supervisores.departamentos.getdepartamentos', 'uses' =>  'Supervisores\SupervisorController@getdepartamentos') );
Route::get('supervisores/departamentos/{supervisores}', array('as' => 'supervisores.departamentos.show', 'uses' =>  'Supervisores\SupervisorController@show') );

Route::get('supervisores/departamentos/agregardepartamento/{emp_id}/{param?}', array('as' => 'supervisores.departamentos.agregardepartamento', 'uses' => 'Supervisores\SupervisorController@agregardepartamento') );

Route::get('supervisores/departamentos/quitardepartamento/{emp_id}/{param?}', array('as' => 'supervisores.departamentos.quitardepartamento', 'uses' => 'Supervisores\SupervisorController@quitardepartamento') );

Route::get('supervisores/indicadores/supervisados/{emp_id}', array('as' => 'supervisores.indicadores.supervisados', 'uses' => 'Supervisores\SupervisorController@supervisados') );


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
Route::auth();

Route::get('/home', 'HomeController@index');
