<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao_lancamento',
        'tipo',
        'status',
        'valor_lancamento',
        'data_compra',
        'data_vencimento',        
        'conta_id',
        'credit_card_id',
        'parcela_inicial',
        'parcela_total',
        'user_id',
        'pessoa_id'
    ];

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function credit_card()
    {
        return $this->belongsTo(CreditCards::class);
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
