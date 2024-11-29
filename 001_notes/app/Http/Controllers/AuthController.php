<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginSubmit(Request $request)
    {
        //Form Validation
        $request->validate(
            [
                'text_username' => 'required | email',
                'text_password' => 'required | min:6 | max:16'
            ],
            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'O username deve ser um E-mail válido',
                'text_password.required' => 'A password é obrigatório',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres',
                'text_password.max' => 'O password deve ter no máximos :max caracteres',
            ]
        );
        //Get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)->where('deleted_at', NULL)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password incorreto!');
        }
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password incorreto!');
        }
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);
        return redirect()->to('/');
    }
    public function logout() {
        session()->forget('user');
        return redirect()->to('/login');
    }
}
