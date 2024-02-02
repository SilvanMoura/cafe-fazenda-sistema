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

        //return $cities;
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
}
