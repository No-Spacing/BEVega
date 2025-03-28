<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('admin')->check() && ($request->path() != 'login' && $request->path() != 'register')){
            return redirect('/login')->with('message','User must be logged in.');
        }

        if(Auth::guard('admin')->check() && ($request->path() == 'login' || $request->path() == 'register')){
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
