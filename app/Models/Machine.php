<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'maquina';

    protected $fillable = [
        'nomemodelo',
        'numeroserie',
        'fabricante_id'
    ];

    public $timestamps = false;
}
