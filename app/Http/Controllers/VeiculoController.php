<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VeiculoController extends Controller
{
    /**
     * Exibe a lista de veículos cadastrados.
     */
    public function index()
    {
        $veiculos = Veiculo::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.veiculos.index', compact('veiculos'));
    }

    /**
     * Mostra o formulário para cadastro de um novo veículo.
     */
    public function create()
    {
        return view('pages.veiculos.create');
    }

    /**
     * Armazena um novo veículo no banco de dados.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'marca'         => 'required|string|max:255',
            'modelo'        => 'required|string|max:255',
            'placa'         => 'required|string|max:10|unique:veiculos,placa',
            'ano'           => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor'           => 'required|string|max:50',
            'valor_diaria'  => 'required|numeric|min:0',
            'imagem'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('veiculos', 'public');
        }

        Veiculo::create($data);

        return redirect()->route('veiculos')
            ->with('success_message', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um veículo.
     */
    public function show(Veiculo $veiculo)
    {
        return view('pages.veiculos.show', compact('veiculo'));
    }

    /**
     * Mostra o formulário para editar um veículo existente.
     */
    public function edit(Veiculo $veiculo)
    {
        return view('pages.veiculos.edit', compact('veiculo'));
    }

    /**
     * Atualiza os dados de um veículo.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        $data = $request->validate([
            'marca'         => 'required|string|max:255',
            'modelo'        => 'required|string|max:255',
            'placa'         => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'ano'           => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor'           => 'required|string|max:50',
            'valor_diaria'  => 'required|numeric|min:0',
            'imagem'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            if ($veiculo->imagem && Storage::disk('public')->exists($veiculo->imagem)) {
                Storage::disk('public')->delete($veiculo->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('veiculos', 'public');
        }

        $veiculo->update($data);

        return redirect()->route('veiculos.show', $veiculo)
            ->with('success_message', 'Dados do veículo atualizados com sucesso!');
    }

    /**
     * Remove um veículo do sistema.
     */
    public function destroy(Veiculo $veiculo)
    {
        if ($veiculo->imagem && Storage::disk('public')->exists($veiculo->imagem)) {
            Storage::disk('public')->delete($veiculo->imagem);
        }

        $veiculo->delete();

        return redirect()->route('veiculos')
            ->with('success_message', 'Veículo excluído com sucesso.');
    }
}
