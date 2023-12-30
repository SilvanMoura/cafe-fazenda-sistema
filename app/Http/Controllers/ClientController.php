<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getInfoClients()
    {
        $infosClients = Client::orderBy('nome', 'asc')->get();
        return view('clients', ['infoClients' => $infosClients]);
    }

    public function newClientSupplier(){
        return view('newClientSupplier');
    }

    public function registerClientSupplier(Request $request){
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
        }else{
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

    public function viewClientSupplier($id){
        return view('viewClientSupplier');
    }
}
