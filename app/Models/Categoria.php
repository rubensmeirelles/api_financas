<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = [
        'nome_categoria',
    ];

    public function lancamentos(): HasMany
    {
        return $this->hasMany(Lancamento::class);
    }
}
