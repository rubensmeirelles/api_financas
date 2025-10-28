<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao_lancamento',
        'tipo_lancamento',
        'conta_id',
        'valor_lancamento',
        'data_vencimento',
        'cliente_id'
    ];
}
