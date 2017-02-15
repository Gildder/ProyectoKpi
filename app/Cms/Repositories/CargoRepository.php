<?php

namespace ProyectoKpi\REpositories;

use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;

class CargoRepository 
{
	public function getIndicadores(Cargo $cargo)
	{
		$result   = Cargo::find($id)->indicadores()->where('indicadores_cargos.cargo_id','=', $cargo->id)->get();
		// $todos_indicadores  = Indicador::select('indicadores.*')->get();
		// $indicadores_libres = $todos_indicadores->diff($result);	

		

		return $result;


	}
}
