<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use Illuminate\Http\Request;

class RepresentationController extends Controller
{
    public function getInfoRepresentation(){
        $representations = Representation::select('*')->get();
        //return $manufacturers;
        return view('representation', ["representations" => $representations]);
    }
}
