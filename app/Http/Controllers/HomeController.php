<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\Financeiro;
use App\Models\User;
use App\Models\Locacao;

class HomeController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::latest()->take(8)->get();
        $clientes = Cliente::all();
        $users = User::all();
        $locacoes = Locacao::with(['cliente', 'veiculo'])->latest()->take(5)->get(); // últimas 5 locações

        $financeiro = Financeiro::first();
        $saldo = $financeiro ? $financeiro->saldo_total : 0;

        return view('pages.home', compact('veiculos', 'clientes', 'users', 'locacoes'));
    }
}
