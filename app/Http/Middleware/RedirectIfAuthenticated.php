<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }

            if (Auth::guard($guard)->check() && Auth::user()->usertype == 1) 
            {
                return redirect()->route('admin.contents.dashboard');
            } 
            elseif (Auth::guard($guard)->check() && Auth::user()->usertype == 2) 
            {
                return redirect()->route('doctor.contents.dashboard');
            } 
            elseif (Auth::guard($guard)->check() && Auth::user()->usertype == 3) 
            {
                return redirect()->route('nurse.contents.dashboard');
            } 
            elseif (Auth::guard($guard)->check() && Auth::user()->usertype == 4) 
            {
                return redirect()->route('patient.contents.dashboard');
            }
        }

        return $next($request);
    }
}
