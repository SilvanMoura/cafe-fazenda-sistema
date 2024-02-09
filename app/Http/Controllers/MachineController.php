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

            $getMachines[$key]['fabricante_id'] = $machine->nome ?? null;
        }

        //return $getMachines;
        return view('machine', ["infoMachines" => $getMachines, "manufactures" => $manufactures]);
    }

    public function createMachine(Request $request)
    {
        Machine::create([
            'nomemodelo' => $request->input('machineNameModelo'),
            'numeroserie' => $request->input('numberSerie'),
            'fabricante_id' => $request->input('manufacturer'),
        ]);

        return response()->json(['message' => 'Máquina registrada com sucesso'], 201);
    }

    public function deleteMachine(Request $request)
    {
        $machine = Machine::findOrFail($request->input('id'));
        $machine->delete();

        return response()->json(['message' => 'Máquina excluida com sucesso'], 201);
    }

    public function updateMachine(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);

        $newNumberSerie = $request->input('numberSerie');

        $existingMachine = Machine::where('numeroserie', $newNumberSerie)
            ->where('id', '<>', $id)
            ->first();

        if ($existingMachine) {
            return response()->json(['message' => 'Número de série já existe em outro registro.'], 400);
        };

        $machine->nomemodelo = $request->input('machineNameModelo');
        $machine->numeroserie = $newNumberSerie;
        
        if ($request->input('manufacturerNew') != '') {
            $machine->fabricante_id = $request->input('manufacturerNew');
        }

        $machine->save();

        return response()->json(['message' => 'Máquina alterada com sucesso'], 201);
    }
}
