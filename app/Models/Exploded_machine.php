<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exploded_machine extends Model
{
    use HasFactory;

    protected $table = 'maquina_explodida';

    protected $fillable = [
        'nome',
        'anexo',
        'fabricante_id'
    ];

    public $timestamps = false;
}
