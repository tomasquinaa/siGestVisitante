<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMidleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   


    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check())
        {
           $user = Auth::user();
           if($user->hasRole(['Super','Admin', 'User'])) {
            return $next($request);
           }

       

            abort(403, "User does not have correct ROLE");

        }

        abort(401);
    }
}


