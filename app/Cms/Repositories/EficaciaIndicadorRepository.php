<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Cms\Abstracts\IndicadorAbstract;
use ProyectoKpi\Cms\Interfaces\IIndicador;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Cms\Clases\SemanaData;
use ProyectoKpi\Cms\Clases\DatoGraficaPorEmpleado;

class EficaciaIndicadorRepository extends IndicadorAbstract implements IIndicador
{
    private $datos;

    /*contructores */
    public function __construct($empleado_id)
    {
        $this->datos = $this->cnGetValorIndicadorPorSemana($empleado_id);
    }

    /**
     * @param $empleado_id
     */
    public function cnGetValorIndicadorPorSemana($empleado_id)
    {
        return \DB::select('call pa_supervisores_EficaciaIndicador(' . $empleado_id . ');');
    }

    public function getTablas($empleado)
    {
        return $this->datos;
    }


    public function getChart($empleado_id)
    {
        foreach ($this->datos as $item) {
            $this->setSemana($item->semana, $item->mes, $item->efeser);
        }

        return $this->getMeses();
    }
}
