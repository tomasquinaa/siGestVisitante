<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function handle()
    {
        // Total de visitantes
        $totalVisitors = Visit::whereNull('exit_time')->count();

        // Total de saídas
        $totalExits = Visit::whereNotNull('exit_time')->count();

        // Total de saídas
        $totalExits = Visit::whereNotNull('exit_time')->count();

        $visits = Visit::whereNotNull('exit_time')->get();

        // Departamento com mais visitas
        $departmentWithMostVisits = Visit::select('department_id', DB::raw('count(*) as total'))
            ->groupBy('department_id')
            ->orderBy('total', 'desc')
            ->first()
            ->department()
            ->first();

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

        return view('admin.dashboard', [
            'totalVisitors' => $totalVisitors,
            'totalExits' => $totalExits,
            'departmentWithMostVisits' => $departmentWithMostVisits,
            'totalExits' => $totalExits,
            'visits' => $visits,
            'chartData' => $chartData
        ]);
    }
}
