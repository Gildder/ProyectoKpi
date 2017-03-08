<?php

namespace ProyectoKpi\Listeners\Tarea;


use ProyectoKpi\Events\Tarea\TareaUpdating;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Indicadores\PrimerIndicador;
use ProyectoKpi\Cms\Clases\Semana;
use Illuminate\Support\Facades\DB;

class IndicadorUpdatingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  TareaSaved  $event
     * @return void
     */
    public function handle(TareaUpdating $event)
    {
        $user = \Auth::user();
        $semana = new Semana;
        $infoSemana = $semana->getSemanasProgramadas($event->tarea['fechaFinEstimado']);

        //Obtener el registro del indicador
        $cantidad = PrimerIndicador::where('gestion',  $infoSemana[0]['anio'])
                        ->where('mes',  $infoSemana[0]['mes'])
                        ->where('semana',  $infoSemana[0]['semana'])
                        ->where('empleado_id', $user->empleado->codigo)
                        ->where('indicador_id',  '1')
                        ->whereNull('deleted_at')
                        ->count();
       
        if ($cantidad > 0) {
            $indicador = PrimerIndicador::where('gestion',  $infoSemana[0]['anio'])
                        ->where('mes',  $infoSemana[0]['mes'])
                        ->where('semana',  $infoSemana[0]['semana'])
                        ->where('empleado_id' , $user->empleado->codigo)
                        ->where('indicador_id' ,  '1')
                        ->whereNull('deleted_at')
                        ->first();

            if($indicador['actpro'] != 0){
                $indicador->decrement('actpro');  
                // formula del Primer Indicador
                $indicador['efeser'] = round(($indicador['actrea']/ $indicador['actpro'])*100, 2 );
                $indicador->save();
            }
        }
    }
}
