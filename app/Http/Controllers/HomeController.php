<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //vai aceder à autenticação no middleware, e se der tudo certo é que vai ter ao dashboard

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hos = Hospital::all();
        return view('dashboard', compact('hos'));
    }

    public function settings() {
        return view('settings', ['user' => Auth::user()]);
    }


    public function changePassword(Request $request){

        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);


        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
            'name' => 'max:255',
            'email' => 'email|max:225|',
        ]);

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->name = request('name');
        $user->email = request('email');
        $user->save();
        return redirect()->back()->with("success","Settings changed successfully !");
    }

    public function contactos() {
        $hosp = Hospital::paginate(10);

        return view('contactos', compact('hosp'));

    }

    public function contactosFiltro (Request $request) {

        $hosp_name = $request->input('hosp');

        $name = Hospital::where('name', 'LIKE', '%'.$hosp_name.'%')->get();
        $nome = Hospital::where('name', 'LIKE', '%'.$hosp_name.'%')->value('name');



        return view('contactos_filtro', compact('name','nome'));


    }


}
