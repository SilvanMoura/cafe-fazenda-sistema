<?php

namespace App\Http\Controllers;

use App\Models\Exploded_machine;
use App\Models\Manufacturer;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Mockery\Undefined;

class ExplodedMachineController extends Controller
{
    public function getInfoExplodedMachine()
    {
        $getExplanation = Exploded_machine::orderByDesc('id')->get();
        $manufacturers = Manufacturer::select('*')->get();

        foreach ($getExplanation as $key => $explanation) {
            $explanation = Manufacturer::select('nome')->where('id', $explanation->fabricante_id)->first();

            $getExplanation[$key]['fabricante_id'] = $explanation->nome;
        }

        return view('exploded-machine', ["infoEexplanation" => $getExplanation, "manufacturers" => $manufacturers]);
    }

    public function createExplodedMachine(Request $request)
    {
        $anexo = $request->file('anexo');
        $anexoNome = time() . '_' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) . '.' . $anexo->getClientOriginalExtension();
        $directory = 'exploded-machines';

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $anexo->move(public_path('/exploded-machines'), $anexoNome);

        $explodedMachine = new Exploded_machine();
        $explodedMachine->nome = $request->input('explodedName-create');
        $explodedMachine->anexo = $anexoNome;
        $explodedMachine->fabricante_id = $request->input('manufacturer');
        $explodedMachine->save();

        return response()->json(['message' => 'Manual cadastrado com sucesso']);
    }
}
