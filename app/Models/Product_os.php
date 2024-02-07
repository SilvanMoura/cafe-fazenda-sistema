<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_os extends Model
{
    use HasFactory;

    protected $table = 'produto_os';

    protected $fillable = [
        'produto_id',
        'os_id',
        'valor_unitario',
        'quantidade'
    ];

    public $timestamps = false;
}