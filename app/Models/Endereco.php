<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    protected $table = 'enderecos';

    protected $fillable = [
        'rua',
        'numero',
        'cidade',
        'estado',
        'cep',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'endereco_id');
    }
}
