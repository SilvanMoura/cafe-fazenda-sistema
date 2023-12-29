<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getInfoClients()
    {
        $infosClients = Client::orderBy('nome', 'asc')->get();
        return view('clients', ['infoClients' => $infosClients]);
    }
}
