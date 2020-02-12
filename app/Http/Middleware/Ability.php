<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use \Exception;

class Ability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $ability)
    {
        $parts = explode('.', $ability);
        if(!user()->can($ability)) {
        		abort(403, 'Access Denied');
        }
        return $next($request);
    }
}
