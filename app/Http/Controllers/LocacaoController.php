<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Models\Cliente;
use App\Models\Financeiro;
use App\Models\Veiculo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LocacaoController extends Controller
{
    /**
     * Exibe a lista de locações.
     */
    public function index()
    {
        $locacoes = Locacao::with(['cliente', 'veiculo', 'user'])
            ->orderBy('data_inicio', 'desc')
            ->paginate(10);

        return view('pages.locacoes.index', compact('locacoes'));
    }

    /**
     * Mostra o formulário de criação de locação.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $veiculos = Veiculo::orderBy('modelo')->get();
        $users    = User::orderBy('name')->get();

        return view('pages.locacoes.create', compact('clientes', 'veiculos', 'users'));
    }

    /**
     * Armazena uma nova locação.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'veiculo_id'   => 'required|exists:veiculos,id',
            'data_inicio'  => 'required|date',
            'data_fim'     => 'required|date|after_or_equal:data_inicio',
        ]);

        // Calcula o custo total com base nos dias e valor diário
        $veiculo = Veiculo::findOrFail($data['veiculo_id']);
        $start = new Carbon($data['data_inicio']);
        $end = new Carbon($data['data_fim']);
        $days = $start->diffInDays($end) + 1; // inclui dia inicial
        $data['valor_total'] = $days * $veiculo->valor_diaria;

        $data['usuario_id'] = Auth::id();

        $financeiro = Financeiro::first();
        if (!$financeiro) {
            $financeiro = Financeiro::create(['saldo_total' => 0]);
        }
        $financeiro->increment('saldo_total', $data['valor_total']);

        Locacao::create($data);

        return redirect()->route('locacoes')
            ->with('success_message', 'Locação criada com sucesso!');
    }

    /**
     * Exibe detalhes de uma locação.
     */
    public function show(Locacao $locacao)
    {
        $locacao->load(['cliente', 'veiculo', 'user']);
        return view('pages.locacoes.show', compact('locacao'));
    }

    /**
     * Mostra o formulário de edição de locação.
     */
    public function edit(Locacao $locacao)
    {
        $clientes = Cliente::orderBy('nome')->get();   // Agora retorna objetos Cliente
        $veiculos = Veiculo::orderBy('modelo')->get(); // Retorna objetos Veiculo
        $users    = User::orderBy('name')->get();      // Retorna objetos User

        return view('pages.locacoes.edit', compact('locacao', 'clientes', 'veiculos', 'users'));
    }

    /**
     * Atualiza uma locação existente.
     */
    public function update(Request $request, Locacao $locacao)
    {
        $data = $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'veiculo_id'   => 'required|exists:veiculos,id',
            'data_inicio'  => 'required|date',
            'data_fim'     => 'required|date|after_or_equal:data_inicio',
        ]);

        $veiculo = Veiculo::findOrFail($data['veiculo_id']);
        $start = new Carbon($data['data_inicio']);
        $end = new Carbon($data['data_fim']);
        $days = $start->diffInDays($end) + 1;
        $data['valor_total'] = $days * $veiculo->valor_diaria;

        $data['usuario_id'] = Auth::id();

        $locacao->update($data);

        return redirect()->route('locacoes', $locacao)
            ->with('success_message', 'Locação atualizada com sucesso!');
    }

    /**
     * Remove uma locação.
     */
    public function destroy(Locacao $locacao)
    {
        $locacao->delete();
        return redirect()->route('locacoes')
            ->with('success_message', 'Locação excluída com sucesso.');
    }
}
