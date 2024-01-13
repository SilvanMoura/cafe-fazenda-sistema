<?php

namespace App\Http\Controllers;

use App\Models\Os;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getInfoServices()
    {
        $getOsOrcamentos = Os::where('operacao_os_id', 1);

        $getOsServicos = Os::select('id')
            ->where(function ($query) {
                $query->where('data_entrega', null);
            })
            ->where('status_os_id', 3);

        return view('services', ['infoOsOrcamentos' => $getOsOrcamentos, 'infoOsServices' => $getOsServicos]);
    }
}
