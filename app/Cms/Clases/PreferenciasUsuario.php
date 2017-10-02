<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 22/07/2017
 * Time: 14:29
 */

namespace ProyectoKpi\Cms\Clases;


use Adldap\Models\User;

class PreferenciasUsuario
{
    private $verFechasEstimadas;
    private $diaLimiteParaBorrarTareas;
    private $diaInicioParaTareaSigSemana;


    public function __construct()
    {
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }

    public function inicializar($user_id)
    {
        $usuario = \DB::table('users')
            ->select('users.evaluado_por')
            ->where('id', $user_id)
            ->first();

        if(isset($usuario->evaluado_por)){
            $preferencias = \DB::table('evaluador_preferencias')
                ->where('evaluador_id', $usuario->evaluado_por)
                ->first();

//            dd($preferencias);

            if(isset($preferencias)){

                $this->verFechasEstimadas = $preferencias->verFechasEstimadas;
                $this->diaLimiteParaBorrarTareas = $preferencias->dialimiteParaBorrarTareas;
                $this->diaInicioParaTareaSigSemana = $preferencias->diaInicioParaTareaSigSemana;
            }else{
                $this->verFechasEstimadas = 1;
                $this->diaLimiteParaBorrarTareas = 1;
                $this->diaInicioParaTareaSigSemana = 1;
            }
        }else{
            $this->verFechasEstimadas = 1;
        }


    }

}
