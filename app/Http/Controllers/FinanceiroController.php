<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;

class FinanceiroController extends Controller
{
    public function index()
    {
        $financeiro = Financeiro::first();
        $saldo = $financeiro ? $financeiro->saldo_total : 0;

        return view('pages.financeiro.index', compact('saldo'));
    }
}
