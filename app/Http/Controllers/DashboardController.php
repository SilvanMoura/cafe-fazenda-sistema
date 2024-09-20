<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Machine;
use App\Models\Os;
use App\Models\Product;
use App\Models\Status_os;
use App\Models\Operation_os;
use App\Models\Product_os;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getInfoDashboard()
    {
        // Lógica para carregar dados da dashboard
        $getClientesNumber = Client::max('id');;

        $getOsNumber = Os::max('id');

        $getProdutoNumber = Product::max('id');

        $getOsOrcamentosNumber = Os::where('operacao_os_id', 1)->count();

        $getOsServicos = Os::select('*')
            ->where(function ($query) {
                $query->where('operacao_os_id', 2);
                //$query->where('status_os_id', '<>', 5);
                $query->where('status_os_id', '<>', 6);
                $query->where('status_os_id', '<>', 9);
                $query->where('data_entrega', null);
            })
            ->orderBy('id', 'desc')
            //->where('status_os_id', 3)
            ->get(); //->count();
        //return $getOsServicos;
        $getMaquinaNumber = Machine::max('id');;

        $getOsOrcamentos = 

        Os::select('*')
        ->where(function ($query) {
            $query->where('operacao_os_id', 1);
            $query->where('status_os_id', '<>', 8);
            $query->where('data_entrega', null);
        })
        ->orderBy('id', 'desc')
        ->get();
        

        /* $getOsServicos = Os::select('*')
            ->where(function ($query) {
                $query->whereNull('data_entrega');
            })
            ->where('operacao_os_id', 2)
            ->orderByDesc('id')
            ->get(); */

        $getOsAll = OS::select('*')
            ->whereNotNull('data_entrega')
            ->orderBy('id', 'desc')
            ->get();

        $userId = Auth::id();
        $userName = User::select('name')->where('id', $userId)->first();

        $dataAtual = Carbon::now()->format('Y-m-d');
        $contagemGarantias = 0;

        foreach ($getOsAll as $chave => $objeto) {
            $result['garantia'] = $objeto->garantia;
            $result['dataEntrega'] = $objeto->data_entrega;

            $dataEntrega = Carbon::createFromFormat('Y-m-d', $result['dataEntrega']);
            $dataTerminoGarantia = $dataEntrega->addDays($result['garantia']);
            $result['garantiaFinalData'] = $dataTerminoGarantia->format('Y-m-d');

            $contagemGarantias += $dataEntrega && $dataAtual <= $dataTerminoGarantia ? 1 : 0;
        }

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

        $dashboard['garantiasNumber'] = $contagemGarantias;
        $dashboard['clientes'] = $getClientesNumber;
        $dashboard['produto'] = $getProdutoNumber;
        $dashboard['os'] = $getOsNumber;
        $dashboard['osOrcamentoNumber'] = $getOsOrcamentosNumber;
        $dashboard['osServicoNumber'] = count($getOsServicos);
        $dashboard['maquinaNumber'] = $getMaquinaNumber;
        $dashboard['osOrcamento'] = $getOsOrcamentos;
        $dashboard['osServicos'] = $getOsServicos;
        /* $dashboard['userName'] = $userName; */

        //return $getOsServicos;
        //view('layouts.app')->with(['userName' => $userName])->view();
        $dashboard = view('dashboard', ['dashboard' => $dashboard]);
        /* $user = view('layouts.app', ['userName' => $userName]); */

        return $dashboard;
    }

    public function myAccount()
    {
        $userId = Auth::id();
        $user = User::select('*')->where('id', $userId)->first();

        return view('account', ['user' => $user]);
    }

    public function osReport(){
        $statusOs = Status_os::select('*')->get();
        return view('osReport', ['statusOs' => $statusOs]);
    }

    public function newPassword(Request $request, $id){
        $user = User::findOrFail($id);
        $user->password = $request->input('novaSenha');
        $user->save();

        return response()->json(['message' => 'Senha atualizada com sucesso'], 201);
    }
}
