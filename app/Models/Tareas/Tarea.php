<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Cms\Clases\Tiempo;


class Tarea extends Model
{

    protected $table = "tareas";
    protected $primarykey = "id";
    
    use SoftDeletes;
    public $timestamps = true;
    
    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'tiempoEstimado', 'fechaInicioSolucion', ' fechaFinSolucion', 'tiempoSolucion', 'estadoTarea_id', ' tipoTarea_id', 'proyecto_id', 'user_id','localizacion_id', 'hora', 'minuto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at', 'deleted_at',
    ];

    /* Relaciones */
    public function users()
    {
        return $this->hasMany('ProyectoKpi\Models\User', 'user_id');
    }

    function proyectos(){
        return $this->hasMany('ProyectoKpi\Models\Tareas\Proyecto', 'proyecto_id');
    }

    public function  notaErrores()
    {
        return $this->hasMany('ProyectiKpi/Models/Tareas/Tarea', 'tarea_id', 'id');
    }

    public function localizaciones()
    {
        return $this->belongsToMany('ProyectoKpi/Models/Localizaciones/Localizacion', 'tarea_realizadas', 'tarea_id', 'localizacion_id', 'id');
    }


    /* ;Metodos de repositorio */

    // Las localizaciones de disponibles para un empleado particular
    public static function getLocalizaciones()
    {
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', \Usuario::get('localizacion_id'))->first();
        $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        return $localizaciones;
    }

    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionesOcupadas($tarea_id)
    {
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', \Usuario::get('localizacion_id'))->first();
        // $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();
        $ubicacionesOcupadas = DB::table('localizaciones')->join('tarea_localizacion','tarea_localizacion.localizacion_id','=', 'localizaciones.id')
                                ->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)
                                ->where('tarea_localizacion.tarea_id',$tarea_id)
                                ->select('localizaciones.id','localizaciones.nombre')->get();


        return $ubicacionesOcupadas;
    }


    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesDisponibles($tarea_id)
    {
        $localizacion = DB::table('localizaciones')->where('localizaciones.id','=', \Usuario::get('localizacion_id'))->first();

        $ubicacionesDisponible  = DB::select('call pa_tareas_ubicaionesDisponibles('.$localizacion->grupoloc_id.','.$tarea_id.');');

        return $ubicacionesDisponible;
    }

     // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesTodos($tarea_id)
    {
        $localizacion = DB::table('localizaciones')->where('localizaciones.id','=', \Usuario::get('localizacion_id'))->first();
        $localizaciones = DB::table('localizaciones')->select('localizaciones.id', 'localizaciones.nombre')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->get();

        return $localizaciones;
    }

    public function getEstado()
    {
        if ($this->attributes['estado'] == '1') {
            return 'Programado';
        }elseif ($this->attributes['estado'] == '2') {
            return 'En Proceso';
        }elseif ($this->attributes['estado'] == '3') {
            return 'Finalizado';
        }
    }

    public function getEstadoColor()
    {
        if ($this->attributes['estado'] == '1') {
            return 'red';
        }elseif ($this->attributes['estado'] == '2') {
            return 'yellow';
        }elseif ($this->attributes['estado'] == '3') {
            return 'green';
        }
    }

    public function getObservacion()
    {
        if ($this->attributes['observaciones'] == '') {
            return 'Ninguna';
        }else{
            return $this->attributes['observaciones'];
        }
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y
     *
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    public function cambiarFormatoEuropeo($fecha)
    {
        if($fecha == null){
            return '00/00/0000';
        }
        $partes=explode('-',$fecha);//se parte la fecha
        $fecha=$partes[2].'/'.$partes[1].'/'.$partes[0];//se cambia para que quede formato d-m-Y
        return trim($fecha);
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y
     *
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    public function cambiarFormatoDB($fecha)
    {
        if($fecha == null){
            return '0000-00-00';
        }
        $partes=explode('/',$fecha);//se parte la fecha
        $fecha=$partes[2].'-'.$partes[1].'-'.$partes[0];//se cambia para que quede formato d-m-Y

        return trim($fecha);
    }

    public function obtenerHora($horas, $minutos)
    {
        $tiempo = new Tiempo;
        
        return $tiempo->obtenerHora($horas, $minutos);
    }


    public function sacarHoras($hora)
    {   
        if($hora == null){
            return '';
        } 
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[0];
    }    

    public function sacarMinutos($hora)
    {     
        if($hora == null){
            return '';
        }
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[1];
    }  



}
