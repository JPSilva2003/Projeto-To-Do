<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('locale')) {
            App::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
