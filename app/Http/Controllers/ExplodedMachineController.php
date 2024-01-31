<?php

namespace App\Http\Controllers;

use App\Models\Exploded_machine;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ExplodedMachineController extends Controller
{
    public function getInfoExplodedMachine(){
        $getExplanation = Exploded_machine::orderByDesc('id')->get();
        $manufactures = Manufacturer::select('*')->get();

        foreach ($getExplanation as $key => $explanation) {
            $explanation = Manufacturer::select('nome')->where('id', $explanation->fabricante_id)->first();

            $getExplanation[$key]['fabricante_id'] = $explanation->nome;
        }

        //return $getExplanation;
        return view('exploded-machine', ["infEexplanation" => $getExplanation, "manufactures" => $manufactures]);
    }
}
