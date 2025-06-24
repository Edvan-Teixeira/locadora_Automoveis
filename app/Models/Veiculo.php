<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';

    protected $fillable = [
        'marca',
        'modelo',
        'ano',
        'placa',
        'cor',
        'imagem',
        'valor_diaria'
    ];

    public function locacoes()
    {
        return $this->hasMany(Locacao::class, 'veiculo_id');
    }
}
