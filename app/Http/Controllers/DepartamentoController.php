<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\LogAcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class DepartamentoController extends Controller
{
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }


    public function handleIndex(Request $request)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // dd($authUser);

        // Filtra os departamentos associados à empresa do usuário autenticado
        $departments = Department::where('company_id', $authUser->company_id)->get();

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
            'informacao' => Auth::user()->name . ' acessou a lista dos departamentos',
        ]);

        return view('admin.departaments.index', [
            'departments' => $departments
        ]);
    }

    public function handleCreate(Request $request)
    {
        LogAcesso::create([
            'ip' => $request->ip(),
            'browser' => $this->agent->browser(),
            'so' => $this->agent->platform(),
            'agente' => $this->agent->match('regexp'),
            'descricao' => $request->server->get('REQUEST_URI'),
            'nome_maquina' => getenv("COMPUTERNAME"),
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'name' => Auth::user() ? Auth::user()->name : 'Guest',
          //  'estado_id' => 1,
            'informacao' => Auth::user()->name . ' acessou a pagina de cadastro',
        ]);

        return view('admin.departaments.departamento');
    }

    public function handleStore(Request $request, Department $department)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Adicione aqui outras validações necessárias
        ]);

        // Adiciona o company_id ao array de dados validados
        $validatedData['company_id'] = $authUser->company_id;

        // Cria o registro no banco de dados com os dados validados, incluindo o company_id
        $department->create($validatedData);

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
            'informacao' => Auth::user()->name . ' cadastro o departamento ' . $department->name,
        ]);

        return redirect()->route('departament.create');
    }
}
