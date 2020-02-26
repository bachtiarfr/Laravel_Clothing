<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsCustomers
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
        if (Auth::user()->role == 'Merchants') {
            return redirect('/Dashboard/Products')->with('errors', 'Access Denied!');
        }
        return $next($request);
    }
}
