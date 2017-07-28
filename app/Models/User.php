<?php

namespace ProyectoKpi\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use ProyectoKpi\Cms\repositories\UserRepository;
use Adldap\Laravel\Traits\AdldapUserModelTrait;

class User extends Authenticatable
{
    use AdldapUserModelTrait;


    /**
    * Los atributos que son asignables en masa.
    *
    * @var array
    */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'state',  'active',  'type', 'hasRelation','codigo','nombres', 'apellidos', 'departamento_id', 'localizacion_id','cargo_id', 'is_supervisor', 'is_evaluador', 'has_indicador', 'tecnico_id', 'evaluado_por', 'evaluador_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
          'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if (isset($this->type)) {
            if ($this->type == '1')
            {
                return true;
            }
        }
        return false;
    }

    public function get($atributo)
    {
        if(isset($atributo))
        {
            return $this->$atributo;
        }else{
            return '-';
        }
    }
    /* Relaciones */
    public function tipo()
    {
        return $this->belongsTo('ProyectoKpi\Models\Empleados\TipoUsuario','type');
    }

    function cargo(){
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Cargo');
    }
    
    function departamento(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Departamento', 'departamento_id', 'id');
    }

    function localizacion(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Localizacion', 'localizacion_id', 'id');
    }

    public function tareas()
    {
        return $this->hasMany('ProyectoKpi\Models\Tareas\Tarea', 'user_id', 'id');
    }

    public function supervisores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado', 'supervisores_empleados', 'supervisor_id', 'user_id', 'codigo');
    }

    //    relacion supervisores con Cargos
    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo', 'supervisor_cargos', 'user_id', 'cargo_id', 'id');
    }

    // relacion de supervisor departamentos
    public function departamentos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Localizaciones\Localizacion', 'supervisor_departamentos', 'user_id', 'departamento_id', 'id');

    }

    public function eficaciaIndicadores()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\EficaciaIndicador', 'user_id', 'codigo');
    }

    /* Metodos Repositorio */
    //Indicadores
    public function primer_indicador()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\IndicadorPrimer');
    }

    public function getCargo($id)
    {
        $cargo =  DB::table('cargos')->select('cargos.nombre')->where('cargos.id',$id)->first();

        return $cargo->nombre;
    }

    public static function getTablaIndicador($emp_id, $ind_id)
    {
        return IndicadorRepository::getTablaIndicador($emp_id, $ind_id);
    }

    public static function getGraficoIndicador($emp_id, $ind_id)
    {
        return IndicadorRepository::getGraficoIndicador($emp_id, $ind_id);
    }


}
