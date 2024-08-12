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
    public function handle(Request $request, Closure $next)
    {
        $account = session('account');

        if ($account && isset($account['access_token'])) {
            $token = $account['access_token'];
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }

    // public function handle(Request $request, Closure $next): Response
    // {
    //    // dd(Auth::user(), session()->all());
    //     if (Auth::check()) {
    
    //         return $next($request);
          
    //     } else {
    //         Auth::logout();
    //         return redirect('/')->with('error', 'Acesso negado.');
    //     }
    // }
}


