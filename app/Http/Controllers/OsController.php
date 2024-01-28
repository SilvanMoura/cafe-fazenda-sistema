<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Operation_os;
use App\Models\Status_os;
use App\Models\Product_os;
use Illuminate\Http\Request;

class OsController extends Controller
{
    public function getInfoOs()
    {

        $getOs = Os::orderByDesc('id')->get();

        $count = count($getOs);
        for ($i = 0; $i < $count; $i++) {
            $valor = $getOs[$i];

            $clienteId = Client::select('nome')->where('id', $valor['cliente_id'])->first();
            $maquinaId = Machine::select('nomemodelo')->where('id', $valor['maquina_id'])->first();
            $operacaoOsId = Operation_os::select('nome')->where('id', $valor['operacao_os_id'])->first();
            $statusOsId = Status_os::select('nome')->where('id', $valor['status_os_id'])->first();

            $getValorOs = Product_os::select('valor_unitario')->where('os_id', $valor['id'])->sum('valor_unitario');
            $getOs[$i]['valor_os'] = $clienteId ? $getValorOs : null;

            $getOs[$i]['cliente_id'] = $clienteId ? $clienteId->nome : null;
            $getOs[$i]['maquina_id'] = $maquinaId ? $maquinaId->nomemodelo : null;
            $getOs[$i]['operacao_os_id'] = $operacaoOsId ? $operacaoOsId->nome : null;
            $getOs[$i]['status_os_id'] = $statusOsId ? $statusOsId->nome : null;
        }
        return $getOs;
        //return view('os');
    }
}
