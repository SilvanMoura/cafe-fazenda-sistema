<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuaranteesController extends Controller
{
    public function guarantees(){
        return view('guarantees');
    }
}
