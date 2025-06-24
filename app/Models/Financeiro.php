<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    protected $table = 'financeiro';
    protected $fillable = ['saldo_total'];
}
