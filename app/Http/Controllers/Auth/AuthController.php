<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('auth.login');
    }

    // public function authlogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     try {
    //         $response = $this->authService->login($request->email, $request->password);

    //         dd($response);

    //         // Armazenar o token na sessão
    //         session(['api_token' => $response['access_token']]);

    //         return redirect('dashboard');

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Invalid email or password');
    //     }
    // }
    public function authlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $response = $this->authService->login($request->email, $request->password);

            // Armazenar o token e o nome na sessão
            session(['api_token' => $response['access_token']]);
            session(['user_name' => $response['user']['shortname']]);

            return redirect('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
