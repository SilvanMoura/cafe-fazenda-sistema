<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getUsers()
    {
        return view('users');
    }

    public function createUser(Request $request)
    {
        User::create([
            'name' => $request->input('userNameModelo'),
            'email' => $request->input('userNameModelo')."@cafedafazenda.com",
            'password' => Hash::make('123456')
        ]);

        return response()->json(['message' => 'Usuário registrado com sucesso'], 201);
    }
}
