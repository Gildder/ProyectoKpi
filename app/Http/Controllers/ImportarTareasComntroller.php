<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Models\ImportarTareas;

class ImportarTareasComntroller extends Controller
{
    public function importar()
    {
        Excel::load('tareas.csv', function ($reader){

            foreach ($reader->get() as $book){
                ImportarTareas::create([
                    'tecnico' => trim($book->tecnico),
                    'tareas'=>trim($book->tarea),
                    'minutos'=>$book->minutos,
                    'fechaInicio'=> $book->fechaInicio,
                    'fechaFin'=> $book->fechaFin,
                    'estado'=> $book->estado,
                    'tienda'=>$book->tienda,
                    'observacion'=>$book->observacion
                ]);
            }
        });

        /* retornamos todos las tareas importadas */
        return ImportarTareas::all();
    }
}
