<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getInfoDashboard()
    {
        // Lógica para carregar dados da dashboard
        return view('dashboard');
    }

}
