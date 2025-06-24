<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    protected $table = 'locacoes';

    protected $fillable = [
        'veiculo_id',
        'usuario_id',
        'cliente_id',
        'data_inicio',
        'data_fim',
        'valor_total'
    ];

    // app/Models/Locacao.php

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];


    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
