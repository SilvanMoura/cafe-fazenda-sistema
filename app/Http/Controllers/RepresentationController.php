<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use Illuminate\Http\Request;

class RepresentationController extends Controller
{
    public function getInfoRepresentation(){
        $representations = Representation::select('*')->get();
        
        return view('representation', ["representations" => $representations]);
    }

    public function createRepresentation(Request $request)
    {
        Representation::create([
            'nome' => $request->input('representationName-create')
        ]);

        return response()->json(['message' => 'Representação registrada com sucesso'], 201);
    }
}
