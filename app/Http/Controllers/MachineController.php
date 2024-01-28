<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function getInfoMachines(){
        return view('machine');
    }
}
