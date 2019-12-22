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
        // $User = Auth::user();
        // $User = $request->user()->role_id;
        // // dd($User);
        if($request->user()->role === 'user') {
            return \redirect('home');
        }
        // dd($request->user());
        return $next($request);
    }
}
