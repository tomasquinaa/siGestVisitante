<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Visit;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    // public function index(Visit $visit)
    // {
    //     //$visits = $visit->all();
    //     // $visits = Visit::with('department')->get();

    //     $visits = Visit::with('department')->where('exit_time', '==', NULL)->get();

    //     return view('visitantes.index', compact('visits'));
    // }

    public function index(Visit $visit)
    {

        $visits = Visit::with('department')->whereNull('exit_time')->get();

        return view('visitantes.index', compact('visits'));
    }

    // public function indexOut(Visit $visit)
    // {
    //     $visits = $visit->all();

    //     return view('visitantes.registo_saida', compact('visits'));
    // }
    public function indexOut(Request $request, Visit $visit)
    {
        $query = $visit->newQuery();

        // Filtra por data de entrada, se fornecida
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        // Obtém os resultados filtrados
        $visits = $query->get();

        return view('visitantes.registo_saida', compact('visits'));
    }

    // Gerar PDF
    public function gerarPdf(Request $request)
    {
        $visits = Visit::orderByDesc('created_at')->get();

        $pdf = Pdf::loadView('visitantes.gerar-pdf', [
            'visits' => $visits
        ])->setPaper('a4', 'portrait');

        return $pdf->download('listar_visita.pdf');

    }


    public function create()
    {
        $departaments = Department::all();  // Adiciona essa linha para buscar todos os visitantes

        // dd($visitors);
        return view('visitantes.dashboard', compact('departaments'));
    }

    public function store(Request $request)
    {
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

        // Criação do registro de visita
        $visit = Visit::create($validatedData);

        // Verificação dos dados cadastrados
        // dd($visit);

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

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('visits.index')->with('success', 'Hora de saída registrada com sucesso.');
    }
}
