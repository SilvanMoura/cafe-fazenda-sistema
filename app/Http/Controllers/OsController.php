<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OsController extends Controller
{
    public function getInfoOs(){
        return view('os');
    }
}
