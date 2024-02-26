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
            } else {
                $osInfo[$chave]['temGarantia'] =  'Não';
            }
        }

        return view('viewClientSupplier', ['infoClient' => $infoClient, 'osInfo' => $osInfo]);
    }

    public function editClientSupplier($id)
    {
        $infosClients = Client::select('*')->where('id', $id)->first();
        $estados = json_decode(file_get_contents(public_path('json/estados.json')))->estados;

        return view('editClientSupplier', ['infoClients' => $infosClients, 'estados' => $estados]);
    }

    public function updateClientSupplier($id, Request $request)
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

        $cliente = Client::findOrFail($id);

        // Atualizar os campos necessários
        $cliente->nome = $request->input('nome');
        $cliente->cpf = $cpf;
        $cliente->cnpj = $cnpj;
        $cliente->pessoa = $pessoaType;
        $cliente->ierg = $request->input('ierg');
        $cliente->telefone = $request->input('telefone');
        $cliente->celular = $request->input('celular');
        $cliente->endereco = $request->input('endereco');
        $cliente->complemento = $request->input('complemento');
        $cliente->bairro = $request->input('bairro');
        $cliente->cep = $request->input('cep');
        $cliente->email = $request->input('email');

        $cliente->cidade_id = $cidade_id[0]['id'];
        $cliente->cidade = $request->input('cidade');
        $cliente->uf = $request->input('estado');

        // Salvar as alterações
        $cliente->save();

        return response()->json(['message' => 'Cliente atualizado com sucesso'], 201);
    }





    public function clientSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform your search logic and return the updated table content
        $infoClients = Client::where('nome', 'like', "%$searchTerm%")
            ->orWhere('cpf', 'like', "%$searchTerm%")
            ->orWhere('cnpj', 'like', "%$searchTerm%")
            ->get();

        return $infoClients;//view('clients', ['infoClients' => $infoClients]);
    }
}
