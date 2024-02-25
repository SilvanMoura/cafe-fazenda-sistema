<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getUsers()
    {
        $users = User::select('*')->get();
        return view('users', ['users' => $users]);
    }

    public function createUser(Request $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('name') . "@cafedafazenda.com",
            'password' => Hash::make('123456')
        ]);

        return response()->json(['message' => 'Usuário registrado com sucesso'], 201);
    }

    public function updateUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return response()->json(['message' => 'Usuário alterado com sucesso'], 201);
    }
}
