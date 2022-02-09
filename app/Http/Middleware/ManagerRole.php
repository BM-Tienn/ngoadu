<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerRole
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
        if (Auth::user()->role != MANAGE) {
            return redirect('admin')->with(['alert-type' => 'error', 'message' => 'You dont have access to here' ]);
        }
        return $next($request);
    }
}
