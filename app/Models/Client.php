<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = [
        'nome',
        'cpf',
        'cnpj',
        'pessoa',
        'ierg',
        'telefone',
        'celular',
        'endereco',
        'complemento',
        'bairro',
        'cep',
        'email',
        'cidade_id',
        'cidade',
        'uf',
    ];

    public $timestamps = false;
}
