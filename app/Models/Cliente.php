<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'rg',
        'data_nascimento',
        'genero',
        'cnh',
        'telefone',
        'celular',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function locacoes()
    {
        return $this->hasMany(Locacao::class, 'cliente_id');
    }
}
