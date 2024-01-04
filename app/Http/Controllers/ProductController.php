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
        //return $infoProduct;
        return view('viewProducts', ['infoProduct' => $infoProduct]);
    }
}
