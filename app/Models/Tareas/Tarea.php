<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


use ProyectoKpi\Cms\Clases\Semana;
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
        'descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'tiempoEstimado', 'fechaInicioSolucion', ' fechaFinSolucion', 'tiempoSolucion', 'estado', ' tipo', 'proyecto_id', 'empleado_id','localizacion_id', 'hora', 'minuto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at', 'deleted_at',
    ];

    public function empleados()
    {
        return $this->hasMany('ProyectoKpi\Models\Empleados\Empleado', 'empleado_id');
    }

    function proyectos(){
        return $this->hasMany('ProyectoKpi\Models\Tareas\Proyecto', 'proyecto_id');
    }

    /* ;Metodos de repositorio */

    // Las localizaciones de disponibles para un empleado particular
    public static function getLocalizaciones()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        return $localizaciones;
    }

    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionesOcupadas($tarea_id)
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        // $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();
        $ubicacionesOcupadas = DB::table('localizaciones')->join('tarea_realizadas','tarea_realizadas.localizacion_id','=', 'localizaciones.id')
                                ->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)
                                ->where('tarea_realizadas.tarea_id',$tarea_id)
                                ->select('localizaciones.id','localizaciones.nombre')->get();


        return $ubicacionesOcupadas;
    }


    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesDisponibles($tarea_id)
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();

        $ubicacionesDisponible  = DB::select('call pa_tareas_ubicaionesDisponibles('.$localizacion->grupoloc_id.','.$tarea_id.');');

        return $ubicacionesDisponible;
    }

     // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesTodos($tarea_id)
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        $localizaciones = DB::table('localizaciones')->select('localizaciones.id', 'localizaciones.nombre')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->get();

        return $localizaciones;
    }

    public function getEstado($id)
    {
        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado == '1') {
            return 'Programado';
        }elseif ($tarea->estado == '2') {
            return 'En Proceso';
        }elseif ($tarea->estado == '3') {
            return 'Finalizado';
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
            return '00';
        } 
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[0];
    }    

    public function sacarMinutos($hora)
    {     
        if($hora == null){
            return '00';
        }
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[1];
    }  



}
