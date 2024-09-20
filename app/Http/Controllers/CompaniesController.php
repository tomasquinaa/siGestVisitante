<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\LogAcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class CompaniesController extends Controller
{
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function handleIndex(Request $request)
    {
        $companies = Companies::all();

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
            'informacao' => Auth::user()->name . ' acessou a lista das empresas',
        ]);

        return view('admin.companies.index', [
            'companies' => $companies
        ]);
    }

    public function handleShow(string|int $id, Request $request)
    {
        if (!$companies = Companies::find($id)) {
            return back();
        }

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
            'informacao' => Auth::user()->name . ' acessou o detalhe da empresa ' . $companies->name,
        ]);

        return view('admin.companies.show', [
            'companies' => $companies
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
            'informacao' => Auth::user()->name . ' acessou a lista de cadastro da empresa',
        ]);

        return view('admin.companies.create');
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

        LogAcesso::create([
            'ip' => $request->ip(),
            'browser' => $this->agent->browser(),
            'so' => $this->agent->platform(),
            'agente' => $this->agent->match('regexp'),
            'descricao' => $request->server->get('REQUEST_URI'),
            'nome_maquina' => getenv("COMPUTERNAME"),
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'name' => Auth::user() ? Auth::user()->name : 'Guest',
         //   'estado_id' => 1,
            'informacao' => Auth::user()->name . 'cadastro a empresa' . $companies->name,
        ]);

        return redirect()->route('companies.index')->with('status', 'Empresa criada com sucesso!');
    }

    public function handleEdit(Companies $companies, string|int $id, Request $request)
    {
        if (!$companies = $companies->where('id', $id)->first()) {
            return back();
        }

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
            'informacao' => Auth::user()->name . ' acessou a lista da empresa ' . $companies->name,
        ]);

        return view('admin.companies.edit', [
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
            'informacao' => Auth::user()->name . ' atualizo a lista da empresa ' . $companies->name,
        ]);

        return redirect()->route('companies.index')->with('status', 'Empresa atualizada com sucesso!');
    }

    public function handleDestroy(string|int $id, Request $request)
    {
        if (!$companies = Companies::find($id)) {
            return back();
        }

        $companies->delete();

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
            'informacao' => Auth::user()->name . ' deleto a empresas ' . $companies->name,
        ]);

        return redirect()->route('companies.index');
    }
}
