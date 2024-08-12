<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function handleCreate()
    {
        return view('departaments.departamento');
    }

    public function handleStore(Request $request, Department $department)
    {
        $data = $request->all();

        $department->create($data);

        return redirect()->route('departament.create');

    }
}
