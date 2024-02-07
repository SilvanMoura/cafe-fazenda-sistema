<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    use HasFactory;

    protected $table = 'os';

    protected $fillable = [
        'cliente_id',
        'maquina_id',
        'operacao_os_id',
        'status_os_id',
        'usuario_id',
        'data',
        'data_avaliacao',
        'obs',
        'descricao_cliente',
        'avaliacao',
        'bebidas_extraidas',
        'cabo',
        'chave',
        'reservatorio',
        'reservatorio_obs',
        'compartimento',
        'compartimento_qtd',
        'locada',
        'adaptador',
        'validador',
        'bomba',
        'bandeja',
        'tampa',
        'produtos',
        'produtos_quais',
        'cofre',
        'cofre_chave',
        'mangueira',
        'tampa_compartimento',
        'tampa_compartimento_qtd',
        'tampa_compartimento_obs',
        'evs',
        'evs_qtd',
        'evs_obs',
        'garantia',
        'data_entrega',
        'checklist',
        'desconto'
    ];

    public $timestamps = false;
}
