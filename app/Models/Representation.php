<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    use HasFactory;

    protected $table = 'representacao';

    protected $fillable = [
        'nome'
    ];

    public $timestamps = false;
}
