<?php

namespace App\Http\Controllers;

use App\DCI;
use App\Dosagem;
use App\Estado;
use App\Forma;
use App\Historico;
use App\Hospital;
use App\Medicamento;
use App\MedicamentoPorCH;
use App\Pedido;
use App\PedidoLinha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicamentoControlador extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listarMedLocal()
    {
        $dci = DCI::all();
        $dosagem = Dosagem::all();
        $forma = Forma::all();
        $medch = MedicamentoPorCH::all();
        $med = Medicamento::all();
        $x = Auth::user()->hospital_id;
        $contagem = MedicamentoPorCH::where('hospital_id', $x)->paginate(5);

        return view('listarmedlocal', compact('medch', 'med', 'dci', 'dosagem', 'forma', 'contagem'));
    }

    public function editMedLocal($id)
    {
        $medch = MedicamentoPorCH::find($id);

        if(isset($medch)) {
            return view ('editarmedlocal', compact('medch'));
        }
        return redirect()->back();
    }


    public function updateMedLocal(Request $request, $id)
    {
        $medch = MedicamentoPorCH::find($id);
        $hist = new Historico();

        if(isset($medch)) {
            $medch->quantidade = $request->input('qtdMed');
            $medch->save();

            $hist->medicamento_id = $medch->medicamento_id;

            $hist->hospital_id = $medch->hospital_id;
            $hist->quantidade = $medch->quantidade;
            $hist->save();
        }

        return redirect('/listarmedlocal')->with("success", "Quantidade atualizada com sucesso!");
    }


    public function listarMedGlobal()
    {
        $med = Medicamento::paginate(10);
        $dci = DCI::all();
        $forma = Forma::all();
        $dosagem = Dosagem::all();
        return view('listarmedglobal', compact('med', 'dci','forma','dosagem'));
    }




}
