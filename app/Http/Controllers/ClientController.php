<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Manufacturer;
use App\Models\Os;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function getInfoClients()
    {
        $infosClients = Client::orderBy('nome', 'asc')->get();
        return view('clients', ['infoClients' => $infosClients]);
    }

    public function newClientSupplier()
    {
        return view('newClientSupplier');
    }

    public function registerClientSupplier(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'ierg' => 'nullable|string',
            'telefone' => 'nullable|string',
            'celular' => 'nullable|string',
            'endereco' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cep' => 'nullable|string',
            'email' => 'nullable|email',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string',
        ]);

        $cleanedString = preg_replace('/[^0-9]/', '', $request->input('documento'));


        if (strlen($cleanedString) === 11) {
            $cpf = $request->input('documento');
            $cnpj = '';
        } else {
            $cnpj = $request->input('documento');
            $cpf = '';
        }

        $pessoaType = $request->has('pessoa') ? 'j' : 'f';

        $cidade_id = City::select('id')->where('nome', $request->input('cidade'))->get();

        $cliente = Client::create([
            'nome' => $request->input('nome'),
            'cpf' => $cpf,
            'cnpj' => $cnpj,
            'pessoa' => $pessoaType,
            'ierg' => $request->input('ierg'),
            'telefone' => $request->input('telefone'),
            'celular' => $request->input('celular'),
            'endereco' => $request->input('endereco'),
            'complemento' => $request->input('complemento'),
            'bairro' => $request->input('bairro'),
            'cep' => $request->input('cep'),
            'email' => $request->input('email'),
            'cidade_id' => $cidade_id[0]['id'],
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('estado'),
        ]);

        return response()->json(['message' => 'Cliente registrado com sucesso', 'registro' => $cliente], 201);
    }

    public function viewClientSupplier($id)
    {
        $infoClient = Client::where('id', $id)->first();

        if (!$infoClient) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }

        $osInfo = Os::where('cliente_id', $id)->get();

        $dataAtual = Carbon::now()->format('Y-m-d');

        foreach ($osInfo as $chave => $valor) {
            $infoMachine = Machine::where('id', $valor['maquina_id'])->first();
            $manufacturerInfo = Manufacturer::where('id', $infoMachine->fabricante_id)->first();
            $infoMachine->fabricante_nome = $manufacturerInfo->nome;
            $osInfo[$chave]->maquinaNome = $infoMachine;

            if ($valor->garantia != 0) {
                $result['garantia'] = $valor->garantia;
                $result['dataEntrega'] = $valor->data_entrega;

                $dataEntrega = Carbon::createFromFormat('Y-m-d', $valor->data_entrega);
                $dataTerminoGarantia = $dataEntrega->addDays($valor->garantia);
                $result['garantiaFinalData'] = $dataTerminoGarantia->format('Y-m-d');

                $osInfo[$chave]['temGarantia'] = $dataEntrega && $dataAtual <= $dataTerminoGarantia ? 'Sim' : 'Não';
            }else{
                $osInfo[$chave]['temGarantia'] =  'Não';
            }
        }

        return view('viewClientSupplier', ['infoClient' => $infoClient, 'osInfo' => $osInfo]);
    }
}
