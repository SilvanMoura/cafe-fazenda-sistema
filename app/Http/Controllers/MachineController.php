<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function getInfoMachines()
    {

        $getMachines = Machine::orderByDesc('id')->get();
        $manufactures = Manufacturer::select('*')->get();

        foreach ($getMachines as $key => $machine) {
            $machine = Manufacturer::select('nome')->where('id', $machine->fabricante_id)->first();

            $getMachines[$key]['fabricante_id'] = $machine->nome;
        }

        //return $getMachines;
        return view('machine', ["infoMachines" => $getMachines, "manufactures" => $manufactures]);
    }

    public function createMachine(Request $request){
        Machine::create([
            'nomemodelo' => $request->input('machineNameModelo'),
            'numeroserie' => $request->input('numberSerie'),
            'fabricante_id' => $request->input('manufacturer'),
        ]);

        return response()->json(['message' => 'Máquina registrada com sucesso'], 201);
    }
}
