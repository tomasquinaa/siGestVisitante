<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function handleIndex()
    {
        $companies = Companies::all();

        return view('companies.index', [
            'companies' => $companies
        ]);
    }

    public function handleShow(string|int $id)
    {
        if (!$companies = Companies::find($id)) {
            return back();
        }

        return view('companies.show', [
            'companies' => $companies
        ]);
    }

    public function handleCreate()
    {
        return view('companies.create');
    }

    public function handleStore(Request $request, Companies $companies)
    {

        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'logo_path' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validação do upload
        ]);

        // Manipulando o upload do arquivo
        $logoPath = 'logos/default_company.png';

        if ($request->hasFile('logo_path')) {
            $file = $request->file('logo_path');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $fileName);
            $logoPath = 'logos/' . $fileName; // Caminho relativo ao diretório público
        }

        // Preparando os dados para serem armazenados no banco de dados
        $data = $request->except('logo_path'); // Remove 'logo_path' do request original
        $data['logo_path'] = $logoPath; // Adiciona o caminho da imagem

        //dd($data);

        // Criando a nova empresa no banco de dados
        $companies->create($data);

        return redirect()->route('companies.index')->with('status', 'Empresa criada com sucesso!');
    }

    public function handleEdit(Companies $companies, string|int $id)
    {
        if (!$companies = $companies->where('id', $id)->first()) {
            return back();
        }

        return view('companies.edit', [
            'companies' => $companies
        ]);
    }

    public function handleUpdate(Request $request, Companies $companies, string $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'logo_path' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validação do upload
        ]);

        // Encontrar a empresa a ser atualizada
        $company = $companies->findOrFail($id);

        // Manipular o upload do arquivo
        $logoPath = $company->logo_path; // Mantém o logo atual por padrão

        if ($request->hasFile('logo_path')) {
            // Remove o logo antigo, se necessário
            if ($logoPath && file_exists(public_path($logoPath))) {
                unlink(public_path($logoPath)); // Remove o arquivo antigo
            }

            // Armazena o novo arquivo
            $file = $request->file('logo_path');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $fileName);
            $logoPath = 'logos/' . $fileName; // Caminho relativo ao diretório público
        }

        // Atualizando os dados da empresa no banco de dados
        $company->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'contact' => $request->input('contact'),
            'logo_path' => $logoPath, // Atualiza o caminho da imagem, se houver
        ]);

        return redirect()->route('companies.index')->with('status', 'Empresa atualizada com sucesso!');
    }

    public function handleDestroy(string|int $id)
    {
        if (!$companies = Companies::find($id)) {
            return back();
        }

        $companies->delete();

        return redirect()->route('companies.index');
    }
}
