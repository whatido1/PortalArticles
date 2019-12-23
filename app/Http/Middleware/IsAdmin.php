<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $User = $request->user();
        if($request->user()->role->role === 'user') {
            return \redirect('/');
        }
        // dd($request->user());
        return $next($request);
    }
}
