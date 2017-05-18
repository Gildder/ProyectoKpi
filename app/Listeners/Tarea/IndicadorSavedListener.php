<?php

namespace ProyectoKpi\Listeners\Tarea;


use ProyectoKpi\Events\Tarea\TareaSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Indicadores\EficaciaIndicador;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use Illuminate\Support\Facades\DB;

class IndicadorSavedListener
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
    public function handle(TareaSaved $event)
    {
        $user = \Auth::user();
        $semana = new CalcularSemana;
        $infoSemana = $semana->getSemanasProgramadas($event->tarea['fechaFinEstimado']);
        $indicador = 'Error';

        $cantidad = EficaciaIndicador::where('gestion', '=' ,  $infoSemana[0]['anio'])
                                    ->where('mes', '=' ,  $infoSemana[0]['mes'])
                                    ->where('semana', '=' ,  $infoSemana[0]['semana'])
                                    ->where( 'empleado_id' , '=' , $user->empleado->codigo)
                                    ->where( 'indicador_id' , '=' ,  '1')
                                    ->whereNull('deleted_at')
                                    ->count();

      // dd($indicador);
        if ($cantidad <= 0) {
            \DB::table('primer_indicador')->insert([
                ['gestion' =>  $infoSemana[0]['anio'] , 'mes' =>  $infoSemana[0]['mes'], 'semana' => $infoSemana[0]['semana'], 'empleado_id' => $user->empleado->codigo, 'indicador_id' =>  '1'],
            ]);     
        }
        
        $indicador = EficaciaIndicador::where('gestion', '=' ,  $infoSemana[0]['anio'])
                  ->where('mes', '=' ,  $infoSemana[0]['mes'])
                  ->where('semana', '=' ,  $infoSemana[0]['semana'])
                  ->where( 'empleado_id' , '=' , $user->empleado->codigo)
                  ->where( 'indicador_id' , '=' ,  '1')
                  ->whereNull('deleted_at')
                  ->first();

        // dd($indicador);
        $indicador->increment('actpro');  

        // formula del Primer Indicador
        $indicador['efeser'] = round(($indicador['actrea']/ $indicador['actpro'])*100, 2 );
        $indicador->save();
    }
}
