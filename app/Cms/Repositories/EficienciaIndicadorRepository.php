<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;


class EficienciaIndicadorRepository
{

    /*contructores */
    public function __construct()
    {
       
    }
    

    /* Metodos */
    public static function getEficienciaIndicador($emp_id)
	{	
		$indicador = DB::select('call pa_supervisores_EficienciaIndicador('.$emp_id.');');

		return $indicador;
	}

	public static function getEficienciaIndicadorChart($emp_id)
	{
		$indicador = DB::select('call pa_supervisores_EficienciaIndicador('.$emp_id.');');

		$lista = Array();
		$datos = Array(0,0,0,0,0,0);

		$contadorMes = -1;
		$mesActual = 0;
		foreach ($indicador as $item) {
			if($item->mes != $mesActual){
				if ($contadorMes >= 0) {
					$lista[$contadorMes] = $datos;
					$datos = Array(0,0,0,0,0,0);
				}

				$contadorMes++;
				$mesActual = $item->mes;

				$datos[0] = Semana::getNombreMes($item->mes);
				$datos[$item->semana] = $item->efeact;
			}else{
				$datos[$item->semana] = $item->efeact;
			}
		}
		$lista[$contadorMes] = $datos;

		return $lista;
	}

	
}