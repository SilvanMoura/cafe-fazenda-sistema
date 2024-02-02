<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function getInfoManufacturers(){
        $manufacturers = Manufacturer::select('*')->orderByDesc('id')->get();
        //return $manufacturers;
        return view('manufacturers', ["manufacturers" => $manufacturers]);
    }

    public function createManufacturer(Request $request)
    {
        Manufacturer::create([
            'nome' => $request->input('manufacturerName-create')
        ]);

        return response()->json(['message' => 'Fabricante registrado com sucesso'], 201);
    }

    public function updateManufacturer(Request $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        $manufacturer->nome = $request->input('manufacturerName');

        $manufacturer->save();

        return response()->json(['message' => 'Fabricante alterado com sucesso'], 201);
    }
}
