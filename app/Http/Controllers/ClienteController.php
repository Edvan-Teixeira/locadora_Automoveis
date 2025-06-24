<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Exibe a lista de clientes.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nome')->paginate(10);
        return view('pages.clientes.index', compact('clientes'));
    }

    /**
     * Mostra o formulário para cadastro de cliente.
     */
    public function create()
    {
        return view('pages.clientes.create');
    }

    /**
     * Armazena um novo cliente no banco de dados.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'              => 'required|string|max:255',
            'email'             => 'required|email|unique:clientes,email|max:255',
            'cpf'               => 'required|string|size:11|unique:clientes,cpf',
            'rg'                => 'required|string|unique:clientes,rg|max:20',
            'data_nascimento'   => 'required|date|before:today',
            'genero'            => 'nullable|in:M,F',
            'cnh'               => 'required|string|unique:clientes,cnh|max:20',
            'telefone'          => 'required|string|max:20',
            'celular'           => 'nullable|string|max:20',
            'logradouro' => 'required|string|max:255',
            'numero'     => 'nullable|string|max:20',
            'bairro'     => 'nullable|string|max:100',
            'cidade'     => 'required|string|max:100',
            'estado'     => 'required|string|size:2',
            'cep'        => 'required|string|max:9',
        ]);

        Cliente::create($data);

        return redirect()->route('clientes')
            ->with('success_message', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um cliente.
     */
    public function show(Cliente $cliente)
    {
        return view('pages.clientes.show', compact('cliente'));
    }

    /**
     * Mostra o formulário para editar um cliente.
     */
    public function edit(Cliente $cliente)
    {
        return view('pages.clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza os dados de um cliente.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nome'              => 'required|string|max:255',
            'email'             => 'required|email|unique:clientes,email,' . $cliente->id . '|max:255',
            'cpf'               => 'required|string|size:11|unique:clientes,cpf,' . $cliente->id,
            'rg'                => 'required|string|unique:clientes,rg,' . $cliente->id . '|max:20',
            'data_nascimento'   => 'required|date|before:today',
            'genero'            => 'nullable|in:M,F',
            'cnh'               => 'required|string|unique:clientes,cnh,' . $cliente->id . '|max:20',
            'telefone'          => 'required|string|max:20',
            'celular'           => 'nullable|string|max:20',
            'logradouro' => 'required|string|max:255',
            'numero'     => 'nullable|string|max:20',
            'bairro'     => 'nullable|string|max:100',
            'cidade'     => 'required|string|max:100',
            'estado'     => 'required|string|size:2',
            'cep'        => 'required|string|max:9',
        ]);

        $cliente->update($data);

        return redirect()->route('clientes.show', $cliente)
            ->with('success_message', 'Dados do cliente atualizados com sucesso!');
    }

    /**
     * Remove um cliente do sistema.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes')
            ->with('success_message', 'Cliente excluído com sucesso.');
    }
}
