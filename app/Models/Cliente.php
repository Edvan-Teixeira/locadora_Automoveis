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
        'endereco_id',
        'telefone',
        'celular',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    public function locacoes()
    {
        return $this->hasMany(Locacao::class, 'cliente_id');
    }
}
