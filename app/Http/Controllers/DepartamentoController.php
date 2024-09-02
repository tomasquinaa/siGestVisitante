<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function handleIndex()
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

        return view('departaments.index', [
            'departments' => $departments
        ]);
    }

    public function handleCreate()
    {
        return view('departaments.departamento');
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

        return redirect()->route('departament.create');
    }
}
