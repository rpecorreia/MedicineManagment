<?php

namespace App\Http\Controllers;

use App\DCI;
use App\Dosagem;
use App\Forma;
use App\Historico;
use App\Medicamento;
use App\MedicamentoPorCH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentoControlador extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //ver movimentos

    public function movimentos(Historico $historico )
    {
        $dci = DCI::all();
        $dosagem = Dosagem::all();
        $forma = Forma::all();
        $hist = Historico::all();
        $med = Medicamento::all();
        $x = Auth::user()->hospital_id;
        $contagem = MedicamentoPorCH::where('hospital_id', $x)->paginate(10);


        return view('movimentos', compact('hist', 'med', 'pesquisadci', 'dosagem', 'forma', 'contagem', 'dci'));

    }


    public function movimentosFiltro(Request $request) {

        $dci_name = $request->input('DCI');
        $x = Auth::user()->hospital_id;

        $name = DCI::where('DCI', 'LIKE', '%'.$dci_name.'%')->value('DCI');
        $id2 = DCI::where('DCI', 'LIKE', '%'.$dci_name.'%')->value('id');

        $med = Medicamento::where('DCI_id', $id2)->get();
        $medid = Medicamento::where('DCI_id', $id2)->pluck('id');
        $medid2 = Medicamento::where('DCI_id', $id2)->get()->last();


        if (isset($medid) && isset($medid2)) {
            $contagem = Historico::where('hospital_id', $x)
                ->where('medicamento_id', $medid)
                ->orWhere('medicamento_id', $medid2)
                ->orderBy('id', 'desc')
                ->paginate(100);
        }
        else{
            $contagem = Historico::where('hospital_id', $x)
                ->orderBy('id', 'desc')
                ->paginate(100);

        }



        $dci = DCI::all();
        $dcinome = DCI::where('id', $id2)->value('DCI');



        return view('movimento_filtro', compact('contagem','med', 'id2','dci_name', 'name','dci','dcinome'));


    }
}
