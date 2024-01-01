<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getInfoProducts()
    {
        $infosProducts = Product::select('*')->orderBy('id', 'desc')->get();
        //return $infosProducts;
        return view('products', ['infoProducts' => $infosProducts]);
    }
}
