<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Operation_os;
use App\Models\Status_os;
use App\Models\Product_os;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Representation;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

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

    public function createOs()
    {
        $clients = Client::select('id', 'nome')->orderBy('nome', 'asc')->get();

        $machines = Machine::orderByDesc('id')->get();

        $infoProduct = Product::select('id', 'nome')->get();

        foreach ($machines as $key => $machine) {
            $machine = Manufacturer::select('nome')->where('id', $machine->fabricante_id)->first();

            $machines[$key]['fabricante_nome'] = $machine->nome;
        }

        //return $infoProduct;
        return view('newOs', ['clients' => $clients, 'machines' => $machines, 'infoProduct' => $infoProduct]);
    }

    public function getClient($id)
    {
        if (Auth::check()) {
            $clients = Client::select('*')->where('id', $id)->get();
            return response()->json(['message' => 'Cliente encontrado com sucesso', 'cliente' => $clients]);
        } else {
            return redirect('/login'); // Redireciona para a página de login
        }
    }

    public function registerOs(Request $request)
    {
        $dataFormatada = Carbon::createFromFormat('d/m/Y', $request->input('data'))->format('Y/m/d');

        $os = Os::create([
            'cliente_id' => $request->input('cliente'),
            'maquina_id' => $request->input('maquina'),
            'operacao_os_id' => '1',
            'status_os_id' => '1',
            'data' => $dataFormatada . ' ' . $request->input('hora'),
            'obs' => $request->input('obs'),
            'descricao_cliente' => $request->input('descricao_cliente'),
            'bebidas_extraidas' => $request->input('bebidas'),
            'cabo' => $request->input('cabo'),
            'chave' => $request->input('chave'),
            'reservatorio' => $request->input('reservatorioAgua'),
            'reservatorio_obs' => $request->input('reservatorioAgua_obs'),
            'compartimento' => $request->input('compartimentos'),
            'compartimento_qtd' => $request->input('compartimentos_qtd'),
            'locada' => $request->input('locada'),
            'adaptador' => $request->input('adaptador'),
            'validador' => $request->input('validador'),
            'bomba' => $request->input('bomba'),
            'bandeja' => $request->input('bandeja'),
            'tampa' => $request->input('tampaReservatorioAgua'),
            'produtos' => $request->input('produtos'),
            'protutos_quais' => $request->input('produtos_quais'),
            'cofre' => $request->input('cofre'),
            'cofre_chave' => $request->input('chaveCofre'),
            'mangueira' => $request->input('mangueira'),
            'tampa_compartimento' => $request->input('tampaCompartimentos'),
            'tampa_compartimento_qtd' => $request->input('tampaCompartimentos_qtd'),
            'tampa_compartimento_obs' => $request->input('tampaCompartimentos_obs'),
            'evs' => $request->input('evs'),
            'evs_qtd' => $request->input('evs_qtd'),
            'evs_obs' => $request->input('evs_obs'),
            'checklist' => $request->input('checklist'),
            //'garantia',
            //'data_entrega',
            //'avaliacao',
            //'usuario_id',
            //'data_avaliacao',
            //'desconto'
        ]);

        $data = $request->all();

        $products = [];
        $number = 1;

        foreach ($data as $key => $value) {
            if (isset($data["select_$number"]) && !empty($data["select_$number"])) {

                $product = Product_Os::create([
                    'produto_id' => $data["select_$number"],
                    'os_id' => $os->id,
                    'valor_unitario' => $data["valUnit_$number"],
                    'quantidade' => $data["qtd_$number"],
                ]);

                $products[] = $product;
                $number++;    
            }else{
                break;
            }
            
        }
        return response()->json(['message' => 'Os registrada com sucesso'], 201);
    }

    public function productsOs(Request $request)
    {
        $infoProduct = Product::select('*')->where('id', $request->input('id'))->get();
        foreach ($infoProduct as $chave => $valor) {
            $representation = Representation::select('nome')->where('id', $valor['representacao_id'])->first();
            $infoProduct[$chave]['nome_representacao'] = $representation->nome;
        }
        return response()->json(['message' => 'Produto encontrado com sucesso', 'product' => $infoProduct], 201);;
    }

    public function editOs($id){
        return view('editOs');
    }
}
