<?php

namespace ProyectoKpi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class EstandarMiddleware
{
   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::user()->isAdmin())
        {
            abort(404);
        }
        

        return $next($request);    
    }
}
