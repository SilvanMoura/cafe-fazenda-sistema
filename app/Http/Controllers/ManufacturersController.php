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
}
