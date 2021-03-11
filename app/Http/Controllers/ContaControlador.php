<?php

namespace App\Http\Controllers;


use App\Admin;
use App\EstadoUser;
use App\Hospital;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ContaControlador extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'hospital_id' => 'required',
            'estado_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'hospital_id' => $data['hospital_id'],
            'estado_id' => $data['estado_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);
    }

    //criar conta
    public function criar()
    {
        $hosp = Hospital::all();
        $estado = EstadoUser::all();
        return view('contas_criar', compact('hosp','estado'));
    }

    public function listar()
    {
        $farmaceuticos = User::where('hospital_id', Auth::user()->hospital_id)->paginate(10);
        $users = User::all();
        $estado = EstadoUser::all();
        return view('contas_listar', compact('farmaceuticos','users','estado'));

    }




}
