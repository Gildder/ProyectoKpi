<?php

namespace ProyectoKpi\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;

use ProyectoKpi\Cms\Semanas\SemanaTarea;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class ApiAuthController extends Controller
{
    /**
     * retorn el token de loguin para el usuario
     *
     * @param Request $request: recibe name = nombre de usuario, password= contraseña
     * @return \Illuminate\Http\JsonResponse
     */
    public function userAuth(Request $request)
    {
        $credendiales = $request->only('name', 'password');
        $token = null;
        $user = null;

        try{
            // validamos la asignacion de attempt
            if(!$token = JWTAuth::attempt($credendiales)){
                return response()->json(['error' => 'credenciales invalido']);
            }
        }catch (JWTException $ex){
            return response()->json(['error'=> 'error de credenciales'], 500);
        }

        // Obtenemos el usuario con el token
        $user = JWTAuth::toUser($token);

        // verificamos si usuario esta activos
        if($user->active == 0){
            return response()->json(['error' => 'credenciales desabilitadas']);
        }

        // verificamos si el usuario esta bloqueado
        if($user->locked == 1){
            return response()->json(['error' => 'credenciales bloqueadas']);
        }

        // Filtramos algunos datos
        $user = User::select('id','name as usuario', 'email as correo', 'nombres', 'apellidos', 'vacacion', 'color', 'texto')
                ->where('id','=', $user->id)
                ->first();

        $semanaTarea = new SemanaTarea();
        $tareas = Tarea::getTareaDeLaSemanaPorUser($semanaTarea, $user->id);


        return response()->json([
            'token' => $token,
            'user' => $user,
            'semana' => $semanaTarea->buscarSemanaDB(Carbon::now()),
            'tareas' => $tareas
        ]);
    }

}

































