<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dashboard;
use App\Models\Machine;
use App\Models\Os;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getInfoDashboard()
    {
        // Lógica para carregar dados da dashboard
        $getClientesNumber = DB::table('cliente')
            ->select('id')
            ->max('id');

        $getOsNumber = DB::table('os')
            ->select('id')
            ->max('id');

        $getProdutoNumber = DB::table('produto')
            ->select('id')
            ->max('id');

        $getOsOrcamentosNumber = DB::table('os')
            ->select('id')
            ->where('operacao_os_id', '=', 1)
            ->count();

        $getOsServicosNumber = DB::table('os')
            ->select('id')
            ->where(function ($query) {
                $query->where('data_entrega', '=', null)
                    ->orWhere('data_entrega', '=', '');
            })
            ->where('status_os_id', '=', 3)
            ->count();

        $getMaquinaNumber = DB::table('maquina')
            ->select('id')
            ->count();

        $getOsOrcamentos = DB::table('os')
            ->select('*')
            ->where('operacao_os_id', '=', 1)
            ->orderBy('id', 'desc')
            ->get();

        $getOsServicos = DB::table('os')
            ->select('*')
            ->where(function ($query) {
                $query->where('data_entrega', '=', null)
                    ->orWhere('data_entrega', '=', '');
            })
            ->where('operacao_os_id', '=', 2)
            ->orderBy('id', 'desc')
            ->get();

        $getOsAll = DB::table('os')
            ->select('*')
            ->whereNotNull('data_entrega')
            ->orderBy('id', 'desc')
            ->get();

        $dashboard['clientes'] = $getClientesNumber;
        $dashboard['produto'] = $getProdutoNumber;
        $dashboard['os'] = $getOsNumber;
        $dashboard['osAll'] = $getOsAll;
        $dashboard['osOrcamentoNumber'] = $getOsOrcamentosNumber;
        $dashboard['osServicoNumber'] = $getOsServicosNumber;
        $dashboard['maquinaNumber'] = $getMaquinaNumber;
        $dashboard['osOrcamento'] = $getOsOrcamentos;
        $dashboard['osServicos'] = $getOsServicos;

        $dataAtual = Carbon::now()->format('Y-m-d');
        $contagemGarantias = 0;

        foreach ($dashboard['osAll'] as $chave => $objeto) {
            $result['garantia'] = $objeto->garantia;
            $result['dataEntrega'] = $objeto->data_entrega;

            $dataEntrega = Carbon::createFromFormat('Y-m-d', $result['dataEntrega']);
            $dataTerminoGarantia = $dataEntrega->addDays($result['garantia']);
            $result['garantiaFinalData'] = $dataTerminoGarantia->format('Y-m-d');

            $contagemGarantias += $dataEntrega && $dataAtual <= $dataTerminoGarantia ? 1 : 0;
        }

        $dashboard['garantiasNumber'] = $contagemGarantias;
        //$dashboard = (object) $dashboard;
        //return $dashboard;
        return view('dashboard', ['dashboard' => $dashboard]);
    }
}
