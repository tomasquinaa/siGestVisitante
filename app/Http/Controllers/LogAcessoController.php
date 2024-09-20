<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogAcesso;
use Illuminate\Http\Request;

class LogAcessoController extends Controller
{
    public function handleLogAcesso()
    {
        $logs =  LogAcesso::all();

        return view('admin.logs.index', [
            'logs' => $logs
        ]);
    }
}
