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

    public function handle(Request $request, Closure $next)
    {
        // Verificar se o token está na sessão
        if (!session('api_token')) {
            return redirect()->route('login');
        }

        // Opcional: Autenticar o usuário com base no ID do usuário armazenado na sessão
        if (session('user')) {
            Auth::loginUsingId(session('user')['id']);
        }

        return $next($request);
    }
}


