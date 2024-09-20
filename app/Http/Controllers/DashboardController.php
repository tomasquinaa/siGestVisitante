<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function handle()
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Total de visitantes
        $totalVisitors = Visit::where('company_id', $authUser->company_id)->whereNull('exit_time')->count();

        // Total de saídas
        $totalExits = Visit::whereNotNull('exit_time')->count();

        // Total de saídas
        $totalExits = Visit::whereNotNull('exit_time')->count();

        $visits = Visit::whereNotNull('exit_time')->get();

        // Obter todos os departamentos
        $totaldepartments = Department::where('company_id', $authUser->company_id)->get();


        // Departamento com mais visitas
        // $departmentWithMostVisits = Visit::select('department_id', DB::raw('count(*) as total'))
        //     ->groupBy('department_id')
        //     ->orderBy('total', 'desc')
        //     ->first();

        // if ($departmentWithMostVisits) {
        //     $departmentWithMostVisits = $departmentWithMostVisits->department;
        // } else {
        //     $departmentWithMostVisits = null; // Ou algum valor padrão se preferir
        // }

        // Contar visitantes por departamento
        $visitorCountsByDepartment = Visit::whereNull('exit_time')->select('department_id', DB::raw('count(*) as total'))
            ->groupBy('department_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $department = Department::find($item->department_id);
                return [$department ? $department->name : 'Sem Departamento' => $item->total];
            });

        // Preparar os dados para o gráfico ou visualização
        $departmentLabels = $visitorCountsByDepartment->keys()->toArray();
        $departmentData = $visitorCountsByDepartment->values()->toArray();

        // Preparando os labels e dados para o gráfico
        $labels = $visits->map(function ($visit) {
            $departmentName = $visit->department ? $visit->department->name : 'Sem Departamento';
            return $visit->name . ' - ' . $departmentName . ' - ' . $visit->related_person;
        })->unique()->values()->toArray();

        // Contagem de visitantes ativos
        $visitorCounts = $visits->countBy(function ($visit) {
            return $visit->name . ' - ' . ($visit->department ? $visit->department->name : 'Sem Departamento') . ' - ' . $visit->related_person;
        })->toArray();

        // Organizando dados para o gráfico
        $chartData = [
            'labels' => array_keys($visitorCounts),
            'data' => array_values($visitorCounts),
        ];

        return view('admin.dashboard.dashboard', [
            'totalVisitors' => $totalVisitors,
            'totalExits' => $totalExits,
          //  'departmentWithMostVisits' => $departmentWithMostVisits,
            'visits' => $visits,
            'chartData' => $chartData,
            'totaldepartments' => $totaldepartments,
            'departmentLabels' => $departmentLabels,
            'departmentData' => $departmentData,
        ]);
    }
}
