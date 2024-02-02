<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getInfoCity(){
        $cities = City::select('*')->get();
        $states = State::select('*')->get();
        
        foreach ($cities as $key => $city) {
            $state = State::select('*')->where('id', $city->estado_id)->first();

            $cities[$key]['estado_id'] = $state->id;
            $cities[$key]['estado_nome'] = " $state->sigla - $state->nome";
        }

        return view('city', ["cities" => $cities, "states" => $states]);
    }

    public function createCity(Request $request)
    {
        City::create([
            'nome' => $request->input('cityName-create'),
            'estado_id' => $request->input('state'),
        ]);

        return response()->json(['message' => 'Cidade registrada com sucesso'], 201);
    }

    public function updateCity(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $city->nome = $request->input('cityName');
        if($request->input('stateEdit') != 'Selecione'){
            $city->estado_id = $request->input('stateEdit');
        }

        $city->save();

        return response()->json(['message' => 'Cidade alterada com sucesso'], 201);
    }

    public function deleteCity(Request $request)
    {
        $city = City::findOrFail($request->input('id'));
        $city->delete();

        return response()->json(['message' => 'Cidade excluida com sucesso'], 201);
    }
}
