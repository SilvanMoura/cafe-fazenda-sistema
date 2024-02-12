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
use SnappyPDF;
use Illuminate\Http\Response;

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

            $machines[$key]['fabricante_nome'] = $machine->nome ?? null;
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
        $avaliacao = Carbon::createFromFormat('d/m/Y', $request->input('dataAvaliacao'))->format('Y/m/d');

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
            'avaliacao' => $request->input('avaliacao'),
            'data_avaliacao' => $avaliacao
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
            } else {
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

    public function editOs($id)
    {
        $clients = Client::select('id', 'nome')->orderBy('nome', 'asc')->get();
        $machines = Machine::orderByDesc('id')->get();

        $os = Os::select('*')->where('id', $id)->first();

        $clientById = Client::select('*')->where('id', $os->cliente_id)->first();
        $machineById = Machine::select('*')->where('id', $os->maquina_id)->first();

        $productsByIdOs = Product_os::select('*')->where('os_id', $os->id)->get();
        foreach ($productsByIdOs as $chave => $valor) {
            $representacao_id = Product::select('representacao_id')->where('id', $valor['produto_id'])->first();
            $productsByIdOs[$chave]['representacao_id'] = $representacao_id->representacao_id;

            $representacao_name = Representation::select('nome')->where('id', $productsByIdOs[$chave]['representacao_id'])->first();
            $productsByIdOs[$chave]['representacao_nome'] = $representacao_name->nome;
        }

        $productsOs = Product::select('*')->get();
        foreach ($productsOs as $chave => $valor) {
            $produtoNome = Product::select('nome')->where('id', $valor['produto_id'])->first();
            if ($produtoNome) {
                $productsOs[$chave]['produto_nome'] = $produtoNome->nome;
            }
        }

        $statusOs = Status_os::select('*')->get();

        $dataCompleta = $os->data;
        $partes = explode(' ', $dataCompleta);

        $data = $partes[0]; // "2024-02-06"
        $hora = $partes[1]; // "22:50:10"

        $dataFormatada = Carbon::createFromFormat('Y-m-d', $data);

        // Formate a data para o formato desejado
        $dataFormatadaFormatada = $dataFormatada->format('d/m/Y');

        $dataAvaliacao = $os->data_avaliacao;
        $dataAvaliacao = Carbon::createFromFormat('Y-m-d', $dataAvaliacao);
        $dataAvaliacao = $dataAvaliacao->format('d/m/Y');

        //return $productsByIdOs;

        return view('editOs', [
            'clients' => $clients,
            'machines' => $machines,
            'os' => $os,
            'clientById' => $clientById,
            'machineById' => $machineById,
            'productsByIdOs' => $productsByIdOs,
            'productsOs' => $productsOs,
            'statusOs' => $statusOs,
            'dataAvaliacao' => $dataAvaliacao,
            'data' => $dataFormatadaFormatada,
            'hora' => $hora,
        ]);
    }

    public function updateOs(Request $request, $id)
    {

        $dataFormatada = Carbon::createFromFormat('d/m/Y', $request->input('data'))->format('Y/m/d');
        $avaliacao = Carbon::createFromFormat('d/m/Y', $request->input('dataAvaliacao'))->format('Y/m/d');

        $os = Os::findOrFail($request->input('os'));

        $os->cliente_id = $request->input('cliente');
        $os->maquina_id = $request->input('maquina');
        $os->operacao_os_id = $request->input('operacao');

        //$os->operacao_os_id = $request->input('status_os_orcamento');
        $os->status_os_id = $os->operacao_os_id != '2' ? $request->input('status_os_orcamento') : $request->input('status_os_servico');
        $os->data = $dataFormatada . ' ' . $request->input('hora');
        $os->obs = $request->input('obs');
        $os->descricao_cliente = $request->input('descricao_cliente');
        $os->bebidas_extraidas = $request->input('bebidas');
        $os->cabo = $request->input('cabo');
        $os->chave = $request->input('chave');
        $os->reservatorio = $request->input('reservatorioAgua');
        $os->reservatorio_obs = $request->input('reservatorioAgua_obs');
        $os->compartimento = $request->input('compartimentos');
        $os->compartimento_qtd = $request->input('compartimentos_qtd');
        $os->locada = $request->input('locada');
        $os->adaptador = $request->input('adaptador');
        $os->validador = $request->input('validador');
        $os->bomba = $request->input('bomba');
        $os->bandeja = $request->input('bandeja');
        $os->tampa = $request->input('tampaReservatorioAgua');
        $os->produtos = $request->input('produtos');
        $os->produtos_quais = $request->input('produtos_quais');
        $os->cofre = $request->input('cofre');
        $os->cofre_chave = $request->input('chaveCofre');
        $os->mangueira = $request->input('mangueira');
        $os->tampa_compartimento = $request->input('tampaCompartimentos');
        $os->tampa_compartimento_qtd = $request->input('tampaCompartimentos_qtd');
        $os->tampa_compartimento_obs = $request->input('tampaCompartimentos_obs');
        $os->evs = $request->input('evs');
        $os->evs_qtd = $request->input('evs_qtd');
        $os->evs_obs = $request->input('evs_obs');
        $os->checklist = $request->input('checklist');
        $os->avaliacao = $request->input('avaliacao');
        $os->data_avaliacao = $avaliacao;

        $os->save();

        $data = $request->all();

        // Passo 1: Obter os registros existentes no banco de dados para a OS atual
        $existingProducts = Product_Os::where('os_id', $id)->get()->keyBy('id');

        $products = [];
        $number = 1;

        foreach ($data as $key => $value) {
            // Passo 2: Comparar os registros existentes com os dados recebidos do formulário
            if (isset($data["select_$number"]) && !empty($data["select_$number"])) {

                $productData = [
                    'produto_id' => $data["select_$number"],
                    'os_id' => $id,
                    'valor_unitario' => $data["valUnit_$number"],
                    'quantidade' => $data["qtd_$number"],
                ];

                // Verificar se o índice está presente no array $data antes de usá-lo
                $productOSKey = "productOS_$number";
                if (isset($data[$productOSKey]) && isset($existingProducts[$data[$productOSKey]])) {
                    // Passo 3: Atualizar ou criar os registros que estão presentes nos dados do formulário
                    $existingProducts[$data[$productOSKey]]->update($productData);
                    $products[] = $existingProducts[$data[$productOSKey]];
                } else {
                    // Criar novo registro
                    $product = Product_Os::create($productData);
                    $products[] = $product;
                }

                $number++;
            } else {
                break;
            }
        }

        // Passo 4: Excluir os registros do banco que não estão presentes nos dados do formulário
        $existingProducts->each(function ($product) use ($products) {
            if (!in_array($product, $products)) {
                $product->delete();
            }
        });

        //return $os;
        return response()->json(['message' => 'Os alterada com sucesso'], 201);
    }

    public function viewOs($id)
    {
        $os = Os::select('*')->where('id', $id)->first();
        foreach ($os as $chave => $valor) {
            $machine_name = Machine::select('nomemodelo')->where('id', $os->maquina_id)->first();
            $operation_name = Operation_os::select('nome')->where('id', $os->operacao_os_id)->first();
            $status_name = Status_os::select('nome')->where('id', $os->status_os_id)->first();

            $os->maquina_nome = $machine_name->nomemodelo;
            $os->operation_name = $operation_name->nome;
            $os->status_name = $status_name->nome;
        }

        $clientById = Client::select('*')->where('id', $os->cliente_id)->first();

        $productsByIdOs = Product_os::select('*')->where('os_id', $os->id)->get();
        foreach ($productsByIdOs as $chave => $valor) {
            $representacao_id = Product::select('representacao_id')->where('id', $valor['produto_id'])->first();
            $productsByIdOs[$chave]['representacao_id'] = $representacao_id->representacao_id;

            $representacao_name = Representation::select('nome')->where('id', $productsByIdOs[$chave]['representacao_id'])->first();
            $productsByIdOs[$chave]['representacao_nome'] = $representacao_name->nome;

            $produto_name = Product::select('nome')->where('id', $productsByIdOs[$chave]['produto_id'])->first();
            $productsByIdOs[$chave]['produto_nome'] = $produto_name->nome;
        }

        $productsOs = Product::select('*')->get();
        foreach ($productsOs as $chave => $valor) {
            $produtoNome = Product::select('nome')->where('id', $valor['produto_id'])->first();
            if ($produtoNome) {
                $productsOs[$chave]['produto_nome'] = $produtoNome->nome;
            }
        }

        $dataCompleta = $os->data;
        $partes = explode(' ', $dataCompleta);

        $data = $partes[0]; // "2024-02-06"
        $hora = $partes[1]; // "22:50:10"

        $dataFormatada = Carbon::createFromFormat('Y-m-d', $data);

        // Formate a data para o formato desejado
        $dataFormatadaFormatada = $dataFormatada->format('d/m/Y');

        $dataAvaliacao = $os->data_avaliacao;
        $dataAvaliacao = Carbon::createFromFormat('Y-m-d', $dataAvaliacao);
        $dataAvaliacao = $dataAvaliacao->format('d/m/Y');

        return view('viewOs', [
            'os' => $os,
            'clientById' => $clientById,
            'productsByIdOs' => $productsByIdOs,
            'dataAvaliacao' => $dataAvaliacao,
            'data' => $dataFormatadaFormatada,
            'hora' => $hora,
        ]);
    }

    public function entregaPDF($idOs)
    {

        $os = Os::select('*')->where('id', $idOs)->first();
        foreach ($os as $chave => $valor) {
            $operation_name = Operation_os::select('nome')->where('id', $os->operacao_os_id)->first();
            $status_name = Status_os::select('nome')->where('id', $os->status_os_id)->first();

            if ($operation_name) {
                $os->operacao_os_id = $operation_name->nome;
            }

            if ($status_name) {
                $os->status_os_id = $status_name->nome;
            }
        }

        $dataCompleta = $os->data;
        $partes = explode(' ', $dataCompleta);

        $data = $partes[0]; // "2024-02-06"
        $hora = $partes[1]; // "22:50:10"

        $dataFormatada = Carbon::createFromFormat('Y-m-d', $data);
        $dataFormatada = $dataFormatada->format('d/m/Y');

        $os->data = $dataFormatada . " " . $hora;

        $dataAvaliacao = $os->data_avaliacao;
        $dataAvaliacao = Carbon::createFromFormat('Y-m-d', $dataAvaliacao);
        $dataAvaliacao = $dataAvaliacao->format('d/m/Y');
        $os->data_avaliacao = $dataAvaliacao;

        $client = Client::select('*')->where('id', $os->cliente_id)->first();
        $machine = Machine::select('*')->where('id', $os->maquina_id)->first();
        foreach ($machine as $chave => $valor) {
            $manufacturer_name = Manufacturer::select('nome')->where('id', $machine->fabricante_id)->first();

            if ($manufacturer_name) {
                $machine->manufacturer_name = $manufacturer_name->nome;
            }
        }

        $productsByIdOs = Product_os::select('*')->where('os_id', $os->id)->get();
        foreach ($productsByIdOs as $chave => $valor) {
            $representacao_id = Product::select('representacao_id')->where('id', $valor['produto_id'])->first();
            $productsByIdOs[$chave]['representacao_id'] = $representacao_id->representacao_id;

            $representacao_name = Representation::select('nome')->where('id', $productsByIdOs[$chave]['representacao_id'])->first();
            $productsByIdOs[$chave]['representacao_nome'] = $representacao_name->nome;

            $produto_name = Product::select('nome')->where('id', $productsByIdOs[$chave]['produto_id'])->first();
            $productsByIdOs[$chave]['produto_nome'] = $produto_name->nome;
        }

        $total = 0;

        foreach ($productsByIdOs as $r) {
            $total += $r->quantidade * $r->valor_unitario;
        }

        //return $os;

        $data = [
            'title' => 'Relatório em PDF',
            'os' => $os,
            'client' => $client,
            'machine' => $machine,
            'products' => $productsByIdOs,
            'total' => $total,
        ];
        $pdf = SnappyPDF::loadView('reportDelivery', $data);

        // Configurar o tipo de resposta para PDF
        $response = new Response($pdf->output());
        $response->header('Content-Type', 'application/pdf');

        return $response;
    }

    public function osPDF($idOs)
    {
        $os = Os::select('*')->where('id', $idOs)->first();
        foreach ($os as $chave => $valor) {
            $operation_name = Operation_os::select('nome')->where('id', $os->operacao_os_id)->first();
            $status_name = Status_os::select('nome')->where('id', $os->status_os_id)->first();

            if ($operation_name) {
                $os->operacao_os_id = $operation_name->nome;
            }

            if ($status_name) {
                $os->status_os_id = $status_name->nome;
            }
        }

        $dataCompleta = $os->data;
        $partes = explode(' ', $dataCompleta);

        $data = $partes[0]; // "2024-02-06"
        $hora = $partes[1]; // "22:50:10"

        $dataFormatada = Carbon::createFromFormat('Y-m-d', $data);
        $dataFormatada = $dataFormatada->format('d/m/Y');

        $os->data = $dataFormatada . " " . $hora;

        $dataAvaliacao = $os->data_avaliacao;
        $dataAvaliacao = Carbon::createFromFormat('Y-m-d', $dataAvaliacao);
        $dataAvaliacao = $dataAvaliacao->format('d/m/Y');
        $os->data_avaliacao = $dataAvaliacao;

        $client = Client::select('*')->where('id', $os->cliente_id)->first();
        $machine = Machine::select('*')->where('id', $os->maquina_id)->first();
        foreach ($machine as $chave => $valor) {
            $manufacturer_name = Manufacturer::select('nome')->where('id', $machine->fabricante_id)->first();

            if ($manufacturer_name) {
                $machine->manufacturer_name = $manufacturer_name->nome;
            }
        }

        $productsByIdOs = Product_os::select('*')->where('os_id', $os->id)->get();
        foreach ($productsByIdOs as $chave => $valor) {
            $representacao_id = Product::select('representacao_id')->where('id', $valor['produto_id'])->first();
            $productsByIdOs[$chave]['representacao_id'] = $representacao_id->representacao_id;

            $representacao_name = Representation::select('nome')->where('id', $productsByIdOs[$chave]['representacao_id'])->first();
            $productsByIdOs[$chave]['representacao_nome'] = $representacao_name->nome;

            $produto_name = Product::select('nome')->where('id', $productsByIdOs[$chave]['produto_id'])->first();
            $productsByIdOs[$chave]['produto_nome'] = $produto_name->nome;
        }

        $total = 0;

        foreach ($productsByIdOs as $r) {
            $total += $r->quantidade * $r->valor_unitario;
        }

        //return $os;

        $data = [
            'title' => 'Relatório em PDF',
            'os' => $os,
            'client' => $client,
            'machine' => $machine,
            'products' => $productsByIdOs,
            'total' => $total,
        ];
        $pdf = SnappyPDF::loadView('reportOs', $data);

        // Configurar o tipo de resposta para PDF
        $response = new Response($pdf->output());
        $response->header('Content-Type', 'application/pdf');

        return $response;
    }
}
