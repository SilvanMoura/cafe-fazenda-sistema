<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Representation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getInfoProducts()
    {
        $infosProducts = Product::select('*')->orderBy('nome')->get();

        //return $infosProducts;
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

    public function updateProduct($id, Request $request){

        $product = Product::findOrFail($id);

        $product->nome = $request->input('nome');
        $product->tags = $request->input('tags');
        $product->descricao = $request->input('descricao');
        $product->representacao_id = $request->input('representacao');
        $product->valor = $request->input('valor');
        $product->estoque = $request->input('estoque');
        $product->estoque_minimo = $request->input('estoqueMinimo');

        $product->save();

        return response()->json(['message' => 'Produto alterado com sucesso'], 201);
    }

    public function updateProductStock($id, Request $request){
        $product = Product::findOrFail($id);

        $product->estoque = $request->input('estoqueAtual') + $request->input('novaQuantidade');

        $product->save();

        return response()->json(['message' => 'Estoque alterado com sucesso'], 201);
    }

    public function deleteProduct($id, Request $request){
        
        $product = Product::findOrFail($request->input('id'));
        $product->delete();

        return response()->json(['message' => 'Produto excluido com sucesso'], 201);
    }

    public function productSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform your search logic and return the updated table content
        $infoProducts = Product::where('nome', 'like', "%$searchTerm%")
            ->orWhere('tags', 'like', "%$searchTerm%")
            ->orWhere('descricao', 'like', "%$searchTerm%")
            ->get();

        return $infoProducts;//view('clients', ['infoClients' => $infoClients]);
    }

}
