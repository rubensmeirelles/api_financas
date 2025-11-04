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
        'status_lancamento',
        'valor_lancamento',
        'data_vencimento',
        'data_pagamento',
        'conta_id',
        'user_id',
        'pessoa_id'
    ];

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
