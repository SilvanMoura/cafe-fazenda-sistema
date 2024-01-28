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

class OsController extends Controller
{
    public function getInfoOs()
    {
        $getOs = Os::orderByDesc('id')->get();

        $count = count($getOs);
        $dataAtual = Carbon::now()->format('Y-m-d');

        foreach ($getOs as $key => $os) {
            $cliente = Client::select('nome')->where('id', $os->cliente_id)->first();
            $maquina = Machine::select('nomemodelo')->where('id', $os->maquina_id)->first();
            $operacaoOs = Operation_os::select('nome')->where('id', $os->operacao_os_id)->first();
            $statusOs = Status_os::select('nome')->where('id', $os->status_os_id)->first();

            $valorOs = Product_os::where('os_id', $os->id)->sum('valor_unitario');

            $getOs[$key]['valor_os'] = $cliente ? $valorOs : null;
            $getOs[$key]['cliente_id'] = $cliente ? $cliente->nome : null;
            $getOs[$key]['maquina_id'] = $maquina ? $maquina->nomemodelo : null;
            $getOs[$key]['operacao_os_id'] = $operacaoOs ? $operacaoOs->nome : null;
            $getOs[$key]['status_os_id'] = $statusOs ? $statusOs->nome : null;

            // Verifica se a data de entrega existe antes de calcular a garantia final
            if ($os->data_entrega) {
                $dataEntrega = Carbon::createFromFormat('Y-m-d', $os->data_entrega);
                $dataTerminoGarantia = $dataEntrega->addDays($os->garantia);
                $getOs[$key]['garantiaFinalData'] = $dataTerminoGarantia->format('Y-m-d');
            } else {
                $getOs[$key]['garantiaFinalData'] = null;
            }
        }

        //return $getOs;
        return view('os', ['getOS' => $getOs]);
    }
}
