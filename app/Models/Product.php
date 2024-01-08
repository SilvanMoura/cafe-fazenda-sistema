<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produto';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'tags',
        'descricao',
        'valor',
        'representacao_id',
        'estoque',
        'estoque_minimo'
    ];
}
