<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Operation_os;
use App\Models\Status_os;
use App\Models\Product_os;
use Carbon\Carbon;

use Illuminate\Http\Request;

class GuaranteesController extends Controller
{
    public function guarantees()
    {

        $getOsAll = OS::select('*')
            ->whereNotNull('data_entrega')
            ->orderBy('data_entrega', 'asc')
            ->get();

        $dataAtual = Carbon::now()->format('Y-m-d');

        foreach ($getOsAll as $index => $objeto) {
            $clienteId = Client::select('nome')->where('id', $objeto->cliente_id)->first();
            $maquinaId = Machine::select('nomemodelo')->where('id', $objeto->maquina_id)->first();
            $operacaoOsId = Operation_os::select('nome')->where('id', $objeto->operacao_os_id)->first();
            $statusOsId = Status_os::select('nome')->where('id', $objeto->status_os_id)->first();

            $getValorOs = Product_os::select('*')->where('os_id', $objeto->id)->get();

            $valorOsArray = [];

            foreach ($getValorOs as $innerIndex => $innerObjeto) {
                $total = $innerObjeto->valor_unitario * $innerObjeto->quantidade;

                if (!isset($valorOsArray[$index]['totalPedido'])) {
                    $valorOsArray[$index]['totalPedido'] = 0;
                }

                $getOsAll[$index]['valor_os'] += $total;
            }

            $dataAvaliacao = $objeto->data_avaliacao;

            $getOsAll[$index]['cliente_id'] = $clienteId ? $clienteId->nome : null;
            $getOsAll[$index]['maquina_id'] = $maquinaId ? $maquinaId->nomemodelo : null;
            $getOsAll[$index]['operacao_os_id'] = $operacaoOsId ? $operacaoOsId->nome : null;
            $getOsAll[$index]['status_os_id'] = $statusOsId ? $statusOsId->nome : null;

            $dataEntrega = Carbon::createFromFormat('Y-m-d', $objeto->data_entrega);
            $dataAvaliacao = Carbon::createFromFormat('Y-m-d', $objeto->data_avaliacao);
            $getOsAll[$index]['data_entrega'] =  $dataEntrega->format('d-m-Y');
            $getOsAll[$index]['data_avaliacao'] =  $dataAvaliacao->format('d-m-Y');
            $dataTerminoGarantia = $dataEntrega->addDays($objeto->garantia);

            if ($dataTerminoGarantia->format('Y-m-d') >= $dataAtual) {
                $getOsAll[$index]['garantiaFinalData'] = $dataTerminoGarantia->format('d-m-Y');
            }
        }

        return view('guarantees', ['getOsAll' => $getOsAll]);
    }
}
