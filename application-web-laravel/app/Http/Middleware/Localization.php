<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * Ce MiddleWare permet de prendre connaissance de
     * la valeur de la locale de la session actuelle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Session::has('locale'))
        {
            \App::setlocale(\Session::get('locale'));
        }
        return $next($request);
    }


}
