<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Cms\Interfaces\IIndicador;
use ProyectoKpi\Cms\Clases\DatoGraficaPorEmpleado;


class EficienciaIndicadorRepository implements IIndicador
{
	private $datos;


    /*contructores */
    public function __construct($empleado_id)
    {
       $this->datos = \DB::select('call pa_supervisores_EficienciaIndicador('.$empleado_id.');');
       
    }
    

    /* Metodos */
    public function getTablas($emp_id)
	{	
		return $this->datos;
	}

	public function getChart($emp_id)
	{
		$lista = array();
        $datos = null;

		$contadorMes = -1;
		$mesActual = 0;
		foreach ($this->datos as $item) {
			// Si el mes de los datos de las tablas es diferne de 0, entonces ingresamos cargar la primera semana del mes de los datos
			// en caso de que el mes de los datos sea igual al actual significa que ya ingreso una ves y se esta recorriendo la semana del mismo mes
			// cada vez que ingrasamos por esta opcion se es porque es un nuevo que y se debe preparar la lista para guardar los datos de las semanas para el nuevo mes
			if($item->mes != $mesActual){
                // Si el contrador del mes es mayor a 0 significa que ya se recorrio por lo menos una vez, y los datos del indicador
                // cuando la variable contadorMes es diferente de su valor inicial -1 significa que ya se tiene el valor del mes de los datos del indicador
                if ($contadorMes >= 0) {
                    $lista[$contadorMes] = $datos;
                }

				// Se crea un Clase Dato de Semana Indicador cada vex que  cambia de Mes
				$datos = new DatoGraficaPorEmpleado();

				$contadorMes++;
				$mesActual = $item->mes;

				$datos->set('gestion', $item->gestion);
				$datos->set('mes',\Calcana::getNombreMes($item->mes));
				$datos->set('semanas', $item->semanas);
				$datos->setValor($item->semana, $item->efeact);
			}else{
                $datos->setValor($item->semana, $item->efeact);
			}


		}
		$lista[$contadorMes] = $datos;
		
		return $lista;
	}

	
}