<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\Set;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class DashboardLang
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
        App::setlocale('en');
        return $next($request);
    }
}
