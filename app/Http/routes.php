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

Route::group(['middleware' => ['auth']], function () {
    //


// **********************  MODULO EMPLEADOS  *****************************************
Route::get('empleados/cargo/eliminados', array('as' => 'empleados.cargo.eliminados', 'uses' => 'Empleados\CargoController@eliminados') );
Route::put('empleados/cargo/restaurar/{cargo}', array('as' => 'empleados.cargo.restaurar', 'uses' => 'Empleados\CargoController@restaurar') );
Route::resource('empleados/cargo', 'Empleados\CargoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
Route::get('empleados/cargo/indicadores/{cargo}', array('as' => 'empleados.cargo.indicadores', 'uses' => 'Empleados\CargoController@indicadores') );
Route::get('empleados/cargo/empleado/{cargo}', array('as' => 'empleados.cargo.empleado', 'uses' => 'Empleados\CargoController@empleado') );
Route::put('empleados/cargo/agregar/{cargo}', array('as' => 'empleados.cargo.agregar', 'uses' => 'Empleados\CargoController@agregar') );
Route::delete('empleados/cargo/quitar/{cargo}/{param?}', array('as' => 'empleados.cargo.quitar', 'uses' => 'Empleados\CargoController@quitar') );


//Empleado
Route::resource('empleados/empleado', 'Empleados\EmpleadoController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);

//Evaludor
Route::get('empleados/evaluador/quitarcargo/{cargo}/{param?}', array('as' => 'empleados.evaluador.quitarcargo', 'uses' => 'Empleados\EvaluadorController@quitarcargo') );
Route::get('empleados/evaluador/agregarcargo/{cargo}/{param?}', array('as' => 'empleados.evaluador.agregarcargo', 'uses' => 'Empleados\EvaluadorController@agregarcargo') );

Route::get('empleados/evaluador/quitarempleado/{empleado}/{param?}', array('as' => 'empleados.evaluador.quitarempleado', 'uses' => 'Empleados\EvaluadorController@quitarempleado') );
Route::get('empleados/evaluador/agregarempleado/{empleado}/{param?}', array('as' => 'empleados.evaluador.agregarempleado', 'uses' => 'Empleados\EvaluadorController@agregarempleado') );
Route::resource('empleados/evaluador', 'Empleados\EvaluadorController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

// Evaluador Empleado
Route::get('empleados/evaluadorempleados', array('as' => 'empleados.evaluadorempleados.index', 'uses' => 'Empleados\EvaluadorEmpleadoController@index') );
Route::get('empleados/evaluadorempleados/show/{empleado}', array('as' => 'empleados.evaluadorempleados.show', 'uses' => 'Empleados\EvaluadorEmpleadoController@show') );




//Evaludor Cargo
Route::resource('empleados/evaluadorcargos', 'Empleados\EvaluadorCargoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
Route::get('empleados/evaluadorcargos/getEvaluadores', 'Empleados\EvaluadorCargoController@getEvaluadores');
Route::get('empleados/evaluadorcargos/getCargos/{id}', 'Empleados\EvaluadorCargoController@getCargos');




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

// Variables de la Formual de un indicador
Route::resource('indicadores/variable', 'Indicadores\VariableController', 
		['only' => ['index', 'create', 'store', 'destroy', 'show']]);

// Indicador Cargo
Route::resource('indicadores/indicadorcargos', 'Indicadores\IndicadorCargoController', 
		['only' => ['index', 'create', 'edit','store', 'destroy', 'show']]);

Route::get('indicadores/indicadorcargos/quitarcargo/{cargo}/{param?}', array('as' => 'indicadores.indicadorcargos.quitarcargo', 'uses' => 'Indicadores\IndicadorCargoController@quitarcargo') );

Route::get('indicadores/indicadorcargos/agregarcargo/{cargo}/{param?}', array('as' => 'indicadores.indicadorcargos.agregarcargo', 'uses' => 'Indicadores\IndicadorCargoController@agregarcargo') );

Route::get('indicadores/indicadorcargos/editar/{cargo}/{param?}', array('as' => 'indicadores.indicadorcargos.editar', 'uses' => 'Indicadores\IndicadorCargoController@editar') );

Route::put('indicadores/indicadorcargos/update/{cargo}/{param?}', array('as' => 'indicadores.indicadorcargos.update', 'uses' => 'Indicadores\IndicadorCargoController@update') );
Route::delete('indicadores/indicadorcargos/destroy/{cargo}/{param?}', array('as' => 'indicadores.indicadorcargos.destroy', 'uses' => 'Indicadores\IndicadorCargoController@destroy') );


// **********************  MODULO SUPERVISORES *****************************************
Route::resource('supervisores/supervisor', 'Supervisores\SupervisorController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);
Route::get('supervisorempleado/departamentos/getDepartamentos', array('as' => 'supervisorempleado.departamentos.getDepartamentos', 'supervisores' =>  'Empleados\SupervisorEmpleadoController') );

Route::get('supervisores/supervisor/agregardepartamento/{emp_id}/{param?}', array('as' => 'supervisores.supervisor.agregardepartamento', 'uses' => 'Supervisores\SupervisorController@agregardepartamento') );

Route::get('supervisores/supervisor/quitardepartamento/{emp_id}/{param?}', array('as' => 'supervisores.supervisor.quitardepartamento', 'uses' => 'Supervisores\SupervisorController@quitardepartamento') );

Route::get('supervisores/indicadores/supervisados/{emp_id}', array('as' => 'supervisores.indicadores.supervisados', 'uses' => 'Supervisores\SupervisorController@supervisados') );

// Empleados Supervisados
Route::resource('supervisores/supervisados', 'Supervisores\SupervisadosController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);

// **********************  MODULO TAREAS  *****************************************
Route::resource('tareas/proyecto', 'Tareas\ProyectoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);


// tareas programadas
Route::get('tareas/tareaProgramadas/archivados', array('as' => 'tareas.tareaProgramadas.archivados', 'uses' => 'Tareas\TareaProgramadaController@archivados') );
Route::resource('tareas/tareaProgramadas', 'Tareas\TareaProgramadaController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

Route::get('tareas/tareaProgramadas/resolver/{tarea}', array('as' => 'tareas.tareaProgramadas.resolver', 'uses' => 'Tareas\TareaProgramadaController@resolver') );
Route::put('tareas/tareaProgramadas/storeResolver/{tarea}', array('as' => 'tareas.tareaProgramadas.storeResolver', 'uses' => 'Tareas\TareaProgramadaController@storeResolver') );


// tareas Diarias
Route::resource('tareas/tareaDiaria', 'Tareas\TareaDiariaController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
Route::get('tareas/tareaDiaria/quitarubicacion/{ubicacion}/{param?}', array('as' => 'tareas.tareaDiaria.quitarubicacion', 'uses' => 'Tareas\TareaDiariaController@quitarubicacion') );
Route::get('tareas/tareaDiaria/agregarubicacion/{ubicacion}/{param?}', array('as' => 'tareas.tareaDiaria.agregarubicacion', 'uses' => 'Tareas\TareaDiariaController@agregarubicacion') );
Route::get('tareas/tareaDiaria/resolver/{tarea}', array('as' => 'tareas.tareaDiaria.resolver', 'uses' => 'Tareas\TareaDiariaController@resolver') );
Route::put('tareas/tareaDiaria/storeResolver/{tarea}', array('as' => 'tareas.tareaDiaria.storeResolver', 'uses' => 'Tareas\TareaDiariaController@storeResolver') );




///fin middleware
});


/* Graficas */
Route::get('graficas/getArrayPrimerIndicador/{data}',  array('as' => 'graficas.getArrayPrimerIndicador', 'uses' => 'Graficas\GraficasController@getArrayPrimerIndicador') );



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
