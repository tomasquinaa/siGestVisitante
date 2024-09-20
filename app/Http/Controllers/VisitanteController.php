<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\LogAcesso;
use App\Models\Visit;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;


class VisitanteController extends Controller
{
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    // public function index(Visit $visit)
    // {
    //     //$visits = $visit->all();
    //     // $visits = Visit::with('department')->get();

    //     $visits = Visit::with('department')->where('exit_time', '==', NULL)->get();

    //     return view('visitantes.index', compact('visits'));
    // }

    public function index(Visit $visit, Request $request)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // Busca as visitas que estão associadas à empresa do usuário autenticado e que ainda não finalizaram (exit_time é NULL)
        $visits = Visit::with('department')
            ->where('company_id', $authUser->company_id)
            ->whereNull('exit_time')
            ->get();

        //  $visits = Visit::with('department')->whereNull('exit_time')->get();

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
            'informacao' => Auth::user()->name . ' acessou a lista dos visitantes ativos na RCS ' ,
        ]);

        return view('admin.visitantes.index', compact('visits'));
    }

    
    public function indexOut(Request $request, Visit $visit)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        $query = $visit->newQuery();

        // Adiciona filtro para a empresa associada
        $query->where('company_id', $authUser->company_id);

        // Filtra por data de entrada, se fornecida
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        // Obtém os resultados filtrados
        $visits = $query->get();

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
            'informacao' => Auth::user()->name . ' Acesso a lista de entrada e saída de visitante ' ,
        ]);

        return view('admin.visitantes.registo_saida', compact('visits'));
    }

    // Gerar PDF
    public function gerarPdf(Request $request)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // $visits = Visit::orderByDesc('created_at')->get();

        // Filtra as visitas associadas à empresa do usuário
        $visits = Visit::where('company_id', $authUser->company_id)
            ->orderByDesc('created_at')
            ->get();

        $pdf = Pdf::loadView('admin.visitantes.gerar-pdf', [
            'visits' => $visits
        ])->setPaper('a4', 'portrait');

        return $pdf->download('listar_visita.pdf');

    }


    public function create(Request $request)
    {
        $departaments = Department::all(); 
         // Adiciona essa linha para buscar todos os visitantes

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
            'informacao' => Auth::user()->name . ' Acesso a pagina de cadastro de vistante',
        ]);

        // dd($visitors);
        return view('admin.visitantes.create', compact('departaments'));
    }

    public function store(Request $request)
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // Validação dos dados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'related_person' => 'nullable|string|max:255',
            'visit_type' => 'required|string|max:255',
            'pass_given' => 'required|string|max:255',
            'entry_time' => 'required|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i',
            'department_id' => 'nullable|exists:departments,id', // Atualizado para não obrigatório
        ]);

        // Adiciona o company_id ao array de dados validados
        $validatedData['company_id'] = $authUser->company_id;

        // Criação do registro de visita
        $visit = Visit::create($validatedData);

        // Verificação dos dados cadastrados
        // dd($visit);

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
            'informacao' => Auth::user()->name . ' Efectuo o cadastro do visitante ' . $visit->name,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('visits.create')->with('success', 'Visita cadastrada com sucesso.');
    }


    // public function updateExitTime(Request $request, Visit $visit)
    // {
    //     // Atualize o campo exit_time e defina o status como 'completed'
    //     $visit->update([
    //         'exit_time' => now()->format('H:i'),
    //     ]);

    //     // Redirecionar com uma mensagem de sucesso
    //     return redirect()->route('visits.index')->with('success', 'Hora de saída registrada com sucesso.');
    // }

    public function updateExitTime(Request $request, Visit $visit)
    {
        // Obtém a hora atual no fuso horário de Angola
        $currentTime = now()->timezone('Africa/Luanda')->format('H:i');

        // Atualize o campo exit_time e defina o status como 'completed'
        $visit->update([
            'exit_time' => $currentTime,
        ]);

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
            'informacao' => Auth::user()->name . ' Atualizo o cadastro do visitante ' . $visit->name,
        ]);

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('visits.index')->with('success', 'Hora de saída registrada com sucesso.');
    }
}
