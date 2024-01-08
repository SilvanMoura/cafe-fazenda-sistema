<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Representation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getInfoProducts()
    {
        $infosProducts = Product::select('*')->orderBy('id', 'desc')->get();
        
        return view('products', ['infoProducts' => $infosProducts]);
    }

    public function viewProducts($id)
    {
        $infoProduct = Product::select('*')->where('id', $id)->get();
        foreach ($infoProduct as $chave => $valor) {
            $representation = Representation::select('nome')->where('id', $valor['representacao_id'])->first();
            $infoProduct[$chave]['nome_representacao'] = $representation->nome;
        }

        return view('viewProducts', ['infoProduct' => $infoProduct]);
    }

    public function editProducts($id)
    {
        $infoProduct = Product::select('*')->where('id', $id)->get();
        foreach ($infoProduct as $chave => $valor) {
            $representation = Representation::select('*')->get();
            $representationName = Representation::select('nome')->where('id', $valor['representacao_id'])->first();
            $infoProduct[$chave]['all_representation'] = $representation;
            $infoProduct[$chave]['nome_representacao'] = $representationName->nome;
        }

        return view('editProduct', ['infoProduct' => $infoProduct]);
    }

    public function newProduct(){
        $representation = Representation::select('*')->get();
        
        //return $infoProduct;
        return view('newProduct', ['infoProduct' => $representation]);
    }

    public function registerProducts(Request $request) {
        $produto = Product::create([
            'nome' => $request->input('nome'),
            'tags' => $request->input('tags'),
            'descricao' => $request->input('descricao'),
            'representacao_id' => $request->input('representacao'),
            'valor' => $request->input('valor'),
            'estoque' => $request->input('estoque'),
            'estoque_minimo' => $request->input('estoqueMinimo'),
        ]);

        return response()->json(['message' => 'Produto registrado com sucesso'], 201);
    }
}
