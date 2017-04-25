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


/**************************** LOGIN ******************************************++*/


Route::auth();

Route::get('/', 'HomeController@index');


// **********************  MODULO ADMINISTRADOR  *****************************************

/*  CARGO */
Route::group(['middleware'=> ['auth', 'administrador'] ], function ()
{
	
	Route::resource('administrador', 'Admin\AdminController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

});

// **********************  MODULO EMPLEADOS  *****************************************



/*  PERFIL */
Route::group(['middleware'=> ['auth', 'estandard'] ], function ()
{
	Route::resource('empleados/perfil', 'Empleados\PerfilController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
});


/*  CARGO */
Route::group(['middleware'=> ['auth', 'administrador'] ], function ()
{
	Route::get('empleados/cargo/eliminados', 
		array('as' => 'empleados.cargo.eliminados', 'uses' => 'Empleados\CargoController@eliminados') );

	Route::put('empleados/cargo/restaurar/{cargo}', 
		array('as' => 'empleados.cargo.restaurar', 'uses' => 'Empleados\CargoController@restaurar') );


	Route::resource('empleados/cargo', 'Empleados\CargoController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);


	Route::get('empleados/cargo/indicadores/{cargo}', 
		array('as' => 'empleados.cargo.indicadores', 'uses' => 'Empleados\CargoController@indicadores') );


	Route::get('empleados/cargo/empleado/{cargo}', 
		array('as' => 'empleados.cargo.empleado', 'uses' => 'Empleados\CargoController@empleado') );

	Route::put('empleados/cargo/agregar/{cargo}', 
		array('as' => 'empleados.cargo.agregar', 'uses' => 'Empleados\CargoController@agregar') );


	Route::delete('empleados/cargo/quitar/{cargo}/{param?}', 
		array('as' => 'empleados.cargo.quitar', 'uses' => 'Empleados\CargoController@quitar') );

});


/* EMPLEADO */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{
	Route::get('empleados/listaDepartamento/{item}', 'Empleados\EmpleadoController@listaDepartamento');
	Route::get('empleados/listaLocalizacion/{item}', 'Empleados\EmpleadoController@listaLocalizacion');



	Route::resource('empleados/empleado', 'Empleados\EmpleadoController', 
		['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
});

// **********************  MODULO EVALUADORES  *****************************************

/* ESCALAS  */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{
	Route::resource('evaluadores/escala', 'Evaluadores\EscalaController', 
		['only' => ['index','create', 'edit', 'store', 'update', 'destroy', 'show']]);
});


/* PONDERACIONES  */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{
	// Escalas
	Route::get('evaluadores/ponderacion/quitarescala/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.quitarescala', 'uses' => 'Evaluadores\PonderacionController@quitarescala') );

	Route::get('evaluadores/ponderacion/agregarescala/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.agregarescala', 'uses' => 'Evaluadores\PonderacionController@agregarescala') );

	// Tipo Indicador
	Route::get('evaluadores/ponderacion/quitartipo/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.quitartipo', 'uses' => 'Evaluadores\PonderacionController@quitartipo') );

	Route::get('evaluadores/ponderacion/agregartipo/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.agregartipo', 'uses' => 'Evaluadores\PonderacionController@agregartipo') );

	//  Indicador
	Route::get('evaluadores/ponderacion/quitarindicador/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.quitarindicador', 'uses' => 'Evaluadores\PonderacionController@quitarindicador') );

	Route::get('evaluadores/ponderacion/agregarindicador/{item}/{param?}', 
		array('as' => 'evaluadores.ponderacion.agregarindicador', 'uses' => 'Evaluadores\PonderacionController@agregarindicador') );

	Route::resource('evaluadores/ponderacion', 'Evaluadores\PonderacionController', 
		['only' => ['index','create', 'edit', 'store', 'update', 'destroy', 'show']]);
});


/* EVALUADOR */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{

	//Cargo
	Route::get('evaluadores/evaluador/quitarcargo/{cargo}/{param?}', 
		array('as' => 'evaluadores.evaluador.quitarcargo', 'uses' => 'Evaluadores\EvaluadorController@quitarcargo') );

	Route::get('evaluadores/evaluador/agregarcargo/{cargo}/{param?}', 
		array('as' => 'evaluadores.evaluador.agregarcargo', 'uses' => 'Evaluadores\EvaluadorController@agregarcargo') );

	//indicadores - nuevo indicador
	Route::get('evaluadores/evaluador/nuevoindicador/{evaluador}', 
		array('as' => 'evaluadores.evaluador.nuevoindicador', 'uses' => 'Evaluadores\EvaluadorController@nuevoindicador') );


	Route::get('evaluadores/evaluador/quitarindicador/{indicador}/{param?}', 
		array('as' => 'evaluadores.evaluador.quitarindicador', 'uses' => 'Evaluadores\EvaluadorController@quitarindicador') );

	Route::get('evaluadores/evaluador/agregarindicador/{evaluador}', 
		array('as' => 'evaluadores.evaluador.agregarindicador', 'uses' => 'Evaluadores\EvaluadorController@agregarindicador') );

	//indicadores - asignar cargos
	Route::get('evaluadores/evaluador/asignarcargo/{indicador}/{evaluador?}', 
		array('as' => 'evaluadores.evaluador.asignarcargo', 'uses' => 'Evaluadores\EvaluadorController@asignarcargo') );

	Route::get('evaluadores/evaluador/agregarcargoasignado/{indicador}/{evaluador}', 
		array('as' => 'evaluadores.evaluador.agregarcargoasignado', 'uses' => 'Evaluadores\EvaluadorController@agregarcargoasignado') );

	Route::get('evaluadores/evaluador/editarcargoasignado/{indicador}/{evaluador}', 
		array('as' => 'evaluadores.evaluador.editarcargoasignado', 'uses' => 'Evaluadores\EvaluadorController@editarcargoasignado') );

	Route::get('evaluadores/evaluador/quitarcargoasignado/{indicador}/{evaluador}/{cargo}', 
		array('as' => 'evaluadores.evaluador.quitarcargoasignado', 'uses' => 'Evaluadores\EvaluadorController@quitarcargoasignado') );


	// Empleado
	Route::get('evaluadores/evaluador/quitarempleado/{empleado}/{param?}', 
		array('as' => 'evaluadores.evaluador.quitarempleado', 'uses' => 'Evaluadores\EvaluadorController@quitarempleado') );

	Route::get('evaluadores/evaluador/agregarempleado/{empleado}/{param?}', 
		array('as' => 'evaluadores.evaluador.agregarempleado', 'uses' => 'Evaluadores\EvaluadorController@agregarempleado') );

	Route::resource('evaluadores/evaluador', 'Evaluadores\EvaluadorController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
	
});

/* EVALUADORES */
Route::group(['middleware'=>['auth', 'estandard']], function ()
{
	//dashBoard
	Route::get('evaluadores/evaluados/dashboard', 
		array('as' => 'evaluadores.evaluados.dashboard', 'uses' => 'Evaluadores\EvaluadosController@dashboard') );


	Route::resource('evaluadores/evaluados', 'Evaluadores\EvaluadosController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
});





// **********************  MODULO LOCALIZACIONES  *****************************************
/* LOCALIZACIOENS */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{

	// Grupo departamento
	Route::get('localizaciones/grupodepartamento/eliminados', 
		array('as' => 'localizaciones.grupodepartamento.eliminados', 'uses' => 'Localizaciones\GrupoDepartamentoController@eliminados') );

	Route::put('localizaciones/grupodepartamento/restaurar/{departamento}', 
		array('as' => 'localizaciones.grupodepartamento.restaurar', 'uses' => 'Localizaciones\GrupoDepartamentoController@restaurar') );

	Route::resource('localizaciones/grupodepartamento', 'Localizaciones\GrupoDepartamentoController', 
			['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);

	Route::get('localizaciones/grupodepartamento/getDepartamentos/{id}', 
			array(
					'as' => 'localizaciones.grupodepartamento.getDepartamentos',
					'uses'=>'Localizaciones\GrupoDepartamentoController@getDepartamentos'
			));


	// departamento
	Route::get('localizaciones/departamento/eliminados', 
		array('as' => 'localizaciones.departamento.eliminados', 'uses' => 'Localizaciones\DepartamentoController@eliminados'));

	Route::put('localizaciones/departamento/restaurar/{departamento}', 
		array('as' => 'localizaciones.departamento.restaurar', 'uses' => 'Localizaciones\DepartamentoController@restaurar'));

	Route::resource('localizaciones/departamento', 'Localizaciones\DepartamentoController', 
			['only' => ['index', 'create',  'edit','store', 'update', 'destroy', 'show']]);

	// GRupo Localizacion
	Route::get('localizaciones/grupolocalizacion/eliminados', 
		array('as' => 'localizaciones.grupolocalizacion.eliminados', 'uses' => 'Localizaciones\GrupoLocalizacionController@eliminados') );

	Route::put('localizaciones/grupolocalizacion/restaurar/{localizacion}', 
		array('as' => 'localizaciones.grupolocalizacion.restaurar', 'uses' => 'Localizaciones\GrupoLocalizacionController@restaurar') );

	Route::resource('localizaciones/grupolocalizacion', 'Localizaciones\GrupoLocalizacionController', ['only' => ['index', 'edit', 'create', 'store', 'update', 'destroy', 'show']]);


	// Localizacion
	Route::get('localizaciones/localizacion/eliminados', 
		array('as' => 'localizaciones.localizacion.eliminados', 'uses' => 'Localizaciones\LocalizacionController@eliminados') );

	Route::put('localizaciones/localizacion/restaurar/{localizacion}', 
		array('as' => 'localizaciones.localizacion.restaurar', 'uses' => 'Localizaciones\LocalizacionController@restaurar') );

	Route::resource('localizaciones/localizacion', 'Localizaciones\LocalizacionController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy','show']]);

});



// **********************  MODULO INDICADORES *****************************************
/* LOCALIZACIOENS */
Route::group(['middleware'=>['auth', 'administrador']], function ()
{
	// Indicador
	Route::post('indicadores/indicador/asignados/{indicador}', array('as' => 'indicadores.indicador.asignados', 'uses' => 'Indicadores\IndicadorController@asignados') );

	Route::get('indicadores/indicador/quitar/{indicador}/{param?}', array('as' => 'indicadores.indicador.quitar', 'uses' => 'Indicadores\IndicadorController@quitar') );

	Route::resource('indicadores/indicador', 'Indicadores\IndicadorController', 
			['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);


	//  Primer Indicador
	Route::resource('indicadores/primerindicador', 'Indicadores\PrimerIndicadorController', 
		['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);


	// Variables
	Route::resource('indicadores/variable', 'Indicadores\VariableController', 
			['only' => ['index', 'create', 'store', 'destroy', 'show']]);

	


});

// **********************  MODULO SUPERVISORES *****************************************

/*  SUPERVISORES */
route::group(['middleware'=>['auth', 'administrador']], function()
{
	/* Metodo Supervisados */
	Route::get('supervisores/supervisor/supervisados/{emp_id}', 
		array('as' => 'supervisores.indicadores.supervisados', 'uses' => 'Supervisores\SupervisorController@supervisados') );

	/* Metodo Show */
	Route::get('supervisores/supervisor/{supervisor}/{param?}', 
		array('as' => 'supervisores.supervisor.show', 'uses' => 'Supervisores\SupervisorController@show') );
	
	/* Metodo agregarcargo */
	Route::get('supervisores/supervisor/agregarcargo/{emp_id}/{param?}', 
		array('as' => 'supervisores.supervisor.agregarcargo', 'uses' => 'Supervisores\SupervisorController@agregarcargo') );
	
	/* Metodo quitarcargo */
	Route::get('supervisores/supervisor/quitarcargo/{emp_id}/{param?}', 
		array('as' => 'supervisores.supervisor.quitarcargo', 'uses' => 'Supervisores\SupervisorController@quitarcargo') );
	
	/* Metodo agregardepartamento */
	Route::get('supervisores/supervisor/agregardepartamento/{emp_id}/{param?}', 
		array('as' => 'supervisores.supervisor.agregardepartamento', 'uses' => 'Supervisores\SupervisorController@agregardepartamento') );

	/* Metodo quitardepartamento */
	Route::get('supervisores/supervisor/quitardepartamento/{emp_id}/{param?}', 
		array('as' => 'supervisores.supervisor.quitardepartamento', 'uses' => 'Supervisores\SupervisorController@quitardepartamento') );

	/* Metodos Genericos */
	Route::resource('supervisores/supervisor', 'Supervisores\SupervisorController', 
		['only' => ['index', 'create', 'store', 'update', 'destroy']]);
});


/*  SUPERVISADOS */
route::group(['middleware'=>['auth', 'supervisores', 'estandard']], function()
{
	/* Metodo agregarErrorTarea */
	Route::get('supervisores/numeroErrores/agregarErrorTarea/{empleado?}', 
		array('as' => 'supervisores.numeroErrores.agregarErrorTarea', 'uses' => 'Supervisores\SupervisadosController@agregarErrorTarea') );

	/* Metodo quitarErrorTarea */
	Route::get('supervisores/numeroErrores/quitarErrorTarea/{empleado}', 
		array('as' => 'supervisores.numeroErrores.quitarErrorTarea', 'uses' => 'Supervisores\SupervisadosController@quitarErrorTarea') );


	/* Metodo obtenerTareasFinalizadas */
	Route::get('supervisores/supervisados/obtenerTareasFinalizadas/{anio}/{mes}/{semana}/{emp}', 
		array('as' => 'supervisores.supervisados.obtenerTareasFinalizadas', 'uses' => 'Supervisores\SupervisadosController@obtenerTareasFinalizadas') );

	/* Metodo obtenerTareasFinalizadas */
	Route::get('supervisores/supervisados/obtenerTareasErrores/{anio}/{mes}/{semana}/{emp}', 
		array('as' => 'supervisores.supervisados.obtenerTareasErrores', 'uses' => 'Supervisores\SupervisadosController@obtenerTareasErrores') );

	/* Metodos Genericos */
	Route::resource('supervisores/supervisados', 'Supervisores\SupervisadosController', 
		['only' => ['index', 'create', 'store', 'update', 'destroy', 'show']]);

});
// **********************  MODULO TAREAS  *****************************************

/*  TAREAS */
route::group(['middleware'=>['auth', 'estandard']], function()
{
	// Proyectos
	Route::resource('tareas/proyecto', 'Tareas\ProyectoController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);
	
	// tareas cancelar programadas
	Route::get('tareas/tareaProgramadas/cancelarSolucion/{tarea}', 
		array('as' => 'tareas.tareaProgramadas.cancelarSolucion', 'uses' => 'Tareas\TareaProgramadaController@cancelarSolucion') );

	// tareas programadas
	Route::get('tareas/tareaProgramadas/archivados', 
		array('as' => 'tareas.tareaProgramadas.archivados', 'uses' => 'Tareas\TareaProgramadaController@archivados') );

	Route::resource('tareas/tareaProgramadas', 'Tareas\TareaProgramadaController', 
		['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'show']]);

	Route::get('tareas/tareaProgramadas/resolver/{tarea}', 
		array('as' => 'tareas.tareaProgramadas.resolver', 'uses' => 'Tareas\TareaProgramadaController@resolver') );

	Route::put('tareas/tareaProgramadas/storeResolver/{tarea}', 
		array('as' => 'tareas.tareaProgramadas.storeResolver', 
			'uses'=> 'Tareas\TareaProgramadaController@storeResolver'));
});

