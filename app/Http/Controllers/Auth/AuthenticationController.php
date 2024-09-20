<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogAcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AuthenticationController extends Controller
{
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function authlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Se a autenticação for bem-sucedida, obtém o usuário autenticado
        $user = Auth::user();

        // Debug: Exibe o usuário autenticado e termina a execução
        //  dd($user);

        LogAcesso::create([
            'ip' => $request->ip(),
            'browser' => $this->agent->browser(),
            'so' => $this->agent->platform(),
            'agente' => $this->agent->match('regexp'),
            'descricao' => $request->server->get('REQUEST_URI'),
            'nome_maquina' => getenv("COMPUTERNAME"),
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'name' => Auth::user() ? Auth::user()->name : 'Guest',
           // 'estado_id' => 1,
            'informacao' => Auth::user()->name . ' Efectuo o login na plataforma visitante',
        ]);

        return redirect('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout successful!');
    }
}
