<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Operation_os;
use App\Models\Product_os;
use App\Models\Status_os;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getInfoServices()
    {
        $getOsOrcamentos = Os::where('operacao_os_id', 1)->get();

        /* $getOsServicos = Os::select('*')
            ->where(function ($query) {
                $query->where('data_entrega', null);
            })
            ->where('status_os_id', 3)
            ->get(); */

        $getOsServicos = Os::select('*')
            ->where(function ($query) {
                $query->where('operacao_os_id', 2);
                $query->where('status_os_id', '<>', 5);
                $query->where('status_os_id', '<>', 6);
                $query->where('status_os_id', '<>', 9);
                $query->where('data_entrega', null);
            })
            ->orderBy('id', 'desc')
            ->get();



        $count = count($getOsOrcamentos);

        for ($i = 0; $i < $count; $i++) {
            $valor = $getOsOrcamentos[$i];

            $clienteId = Client::select('nome')->where('id', $valor['cliente_id'])->first();
            $maquinaId = Machine::select('nomemodelo')->where('id', $valor['maquina_id'])->first();
            $operacaoOsId = Operation_os::select('nome')->where('id', $valor['operacao_os_id'])->first();
            $statusOsId = Status_os::select('nome')->where('id', $valor['status_os_id'])->first();

            $getOsOrcamentos[$i]['cliente_id'] = $clienteId ? $clienteId->nome : null;
            $getOsOrcamentos[$i]['maquina_id'] = $maquinaId ? $maquinaId->nomemodelo : null;
            $getOsOrcamentos[$i]['operacao_os_id'] = $operacaoOsId ? $operacaoOsId->nome : null;
            $getOsOrcamentos[$i]['status_os_id'] = $statusOsId ? $statusOsId->nome : null;
        }

        $count = count($getOsServicos);
        for ($i = 0; $i < $count; $i++) {
            $valor = $getOsServicos[$i];

            $clienteId = Client::select('nome')->where('id', $valor['cliente_id'])->first();
            $maquinaId = Machine::select('nomemodelo')->where('id', $valor['maquina_id'])->first();
            $operacaoOsId = Operation_os::select('nome')->where('id', $valor['operacao_os_id'])->first();
            $statusOsId = Status_os::select('nome')->where('id', $valor['status_os_id'])->first();

            $getValorOs = Product_os::select('valor_unitario')->where('os_id', $valor['id'])->sum('valor_unitario');
            $getOsServicos[$i]['valor_os'] = $clienteId ? $getValorOs : null;

            $getOsServicos[$i]['cliente_id'] = $clienteId ? $clienteId->nome : null;
            $getOsServicos[$i]['maquina_id'] = $maquinaId ? $maquinaId->nomemodelo : null;
            $getOsServicos[$i]['operacao_os_id'] = $operacaoOsId ? $operacaoOsId->nome : null;
            $getOsServicos[$i]['status_os_id'] = $statusOsId ? $statusOsId->nome : null;
        }



        //return $getOsOrcamentos;
        return view('services', ['infoOsOrcamentos' => $getOsOrcamentos, 'infoOsServices' => $getOsServicos]);
    }
}
