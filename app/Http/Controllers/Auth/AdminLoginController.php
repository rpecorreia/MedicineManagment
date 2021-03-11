<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        //se o user estiver logado como admin, não precisamos de aceder à tela de login do admin
        $this->middleware('guest:admin');
    }

    public function login (Request $request){
        //validação dos campos
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //credenciais do utilizador
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //tentativa de login
        $authOK = Auth::guard('admin')->attempt($credentials, $request->remember);

        if($authOK){
            //return redirect('/admin');
            return redirect()->intended(route('admin.dashboard'));

        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function index()
    {
        return view('auth.admin-login');
    }
}