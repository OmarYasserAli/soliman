<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\Set;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class Localization
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
        if(Session::has('locale'))
        {
            App::setlocale(Session::get('locale'));
        }else{
            Session::put('locale', 'ar');
            App::setlocale('ar');
        }
        return $next($request);
    }
}
