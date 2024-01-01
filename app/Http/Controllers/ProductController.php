<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getInfoProducts()
    {
        $infosProducts = Product::select('*')->get();
        return view('products', ['infoProducts' => $infosProducts]);
    }
}
