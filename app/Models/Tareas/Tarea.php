<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use function print_r;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Clases\Tiempo;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use function strtotime;


class Tarea extends Model
{

    protected $table = "tareas";
    protected $primarykey = "id";

    use SoftDeletes;

    /* agrego los datos del repositorio */
    use TareaRepository;

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
        'id','numero','descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'tiempoEstimado', 'fechaInicioSolucion', ' fechaFinSolucion', 'tiempoSolucion', 'estadoTarea_id', ' tipoTarea_id', 'proyecto_id', 'user_id','localizacion_id', 'hora', 'minuto'
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

    function estados(){
        return $this->belongsTo('ProyectoKpi\Models\Tareas\Estados','estadoTarea_id');

    }

    public function  notaErrores()
    {
        return $this->hasMany('ProyectiKpi/Models/Tareas/Tarea', 'tarea_id', 'id');
    }

    public function localizaciones()
    {
        return $this->belongsToMany('ProyectoKpi/Models/Localizaciones/Localizacion', 'tarea_localizacion', 'tarea_id', 'localizacion_id', 'id');
    }


    /* ;Metodos de repositorio */



    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionTarea($tarea_id)
    {
        return
            DB::table('localizaciones')
            ->join('tarea_localizacion','tarea_localizacion.localizacion_id','=', 'localizaciones.id')
            ->where('tarea_localizacion.tarea_id',$tarea_id)
            ->select('localizaciones.id','localizaciones.nombre')->get();




        /*
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion')))
        {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id', \Usuario::get('localizacion')->id)->first();
        // $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        $ubicacionesOcupadas = DB::table('localizaciones')->join('tarea_localizacion','tarea_localizacion.localizacion_id','=', 'localizaciones.id')
            ->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)
            ->where('tarea_localizacion.tarea_id',$tarea_id)
            ->select('localizaciones.id','localizaciones.nombre')->get();


        return $ubicacionesOcupadas;
        }else{
            return [];
        }
*/
    }


    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesDisponibles($tarea_id)
    {
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion')))
        {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id','=', \Usuario::get('localizacion')->id)->first();

        $ubicacionesDisponible  = DB::select('call pa_tareas_ubicaionesDisponibles('.$localizacion->grupoloc_id.','.$tarea_id.');');

        return $ubicacionesDisponible;
        }else{
            return [];
        }
    }

     // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesTodos($tarea_id)
    {
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion'))) {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id', '=', \Usuario::get('localizacion')->id)->first();
            $localizaciones = DB::table('localizaciones')->select('localizaciones.id', 'localizaciones.nombre')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->get();

            return $localizaciones;
        }else{
            return [];
        }
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d/m/Y
     *
     * @param string $fecha
     * @return fecha en formato d/m/Y
     */
    public function cambiarFormatoEuropeo($fecha)
    {
        if(isset($fecha)){
            $partes=explode('-',$fecha);//se parte la fecha
            $fecha=$partes[2].'/'.$partes[1].'/'.$partes[0];
            return $fecha;
        }else{
            return '00/00/0000';
        }
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y
     *
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    public function cambiarFormatoDB($fecha)
    {
        if(isset($fecha)){
            $partes=explode('/',$fecha);//se parte la fecha
            $fecha=$partes[2].'-'.$partes[1].'-'.$partes[0];
            return $fecha;
        }else{
            return '0000-00-00';
        }
    }


    public function validarDuracionCeros()
    {
        if((string) $this->tiempoEstimado == '0:0'){
            return false;
        }else{
            return true;
        }
    }
}
