<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DCI;
use App\Dosagem;
use App\Estado;
use App\EstadoPedido;
use App\Forma;
use App\Historico;
use App\Hospital;
use App\Medicamento;
use App\MedicamentoPorCH;
use App\Pedido;
use App\PedidoLinha;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoControlador extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fazerPedido()
    {
        $hosp = Hospital::all();
        $estado = Estado::all();
        $med= Medicamento::paginate(10);
        $dci= DCI::all();
        $forma= Forma::all();
        $dosagem = Dosagem::all();
        $selectedMed = Medicamento::first()->id;

        return view('fazerpedido', compact('hosp', 'estado','med', 'dci','forma','dosagem','selectedMed'));

    }

    public function store(Request $request)
    {
        $idmed = $request->get('idMed');
        $hospital = $request->get('wizard-progress2-hospital');
        $estado = $request->get('wizard-progress2-estado');
        $quantidade = $request->get('qtdMed');

        $find = Medicamento::findOrFail($idmed)->get();

        if(isset($find)) {

            $pedido1 = new Pedido();
            $pedidolinha = new PedidoLinha();
            $pedido2 = new Pedido();

            $pedido1->user_id = Auth::user()->id;
            $pedido1->estado_id = $estado;
            $pedido1->tipo_id = 1;
            $pedido1->hospital_id_origem = Auth::user()->hospital_id;
            $pedido1->hospital_id_destino = $hospital;
            $pedido1->estado_pedido_id = 1;
            $pedido1->save();

            $pedidolinha->pedido_id = $pedido1->id;
            $pedidolinha->medicamento_id = $idmed;
            $pedidolinha->quantidade = $quantidade;
            $pedidolinha->save();

            $pedido2->user_id = Auth::user()->id;
            $pedido2->estado_id = $estado;
            $pedido2->tipo_id = 2;
            $pedido2->hospital_id_origem = Auth::user()->hospital_id;
            $pedido2->hospital_id_destino = $hospital;
            $pedido2->estado_pedido_id = 1;
            $pedido2->save();

        }

        else{
            return redirect('/fazerpedido')->with("error", "Esse ID não existe. Por favor escolha um ID válido!");

        }

        return redirect('/fazerpedido')->with("success", "Pedido enviado com sucesso!");

    }

    public function pedidosEnviados()
    {
        $hospu = Auth::user()->hospital_id;
        $pdd = Pedido::where('tipo_id', 1)->where('hospital_id_origem', '=' , $hospu )->orderBy('id', 'desc')->paginate(10);

        $pddlinha = PedidoLinha::all();
        $med = Medicamento::all();
        $estado = Estado::all();
        $hosp = Hospital::all();
        $admin = Admin::where('hospital_id' , $hospu)->get();
        $user = User::where('hospital_id' , $hospu)->get();
        $estadopdd = EstadoPedido::all();

        return view('pedidosenviados', compact('table','pdd','pddlinha','med','estado','hosp','hospu', 'admin','user','estadopdd'));

    }

    public function pedidosEnviadosID($id)
    {
        $med = Medicamento::all();
        $estado = Estado::all();
        $estadopdd = EstadoPedido::all();
        $dci = DCI::all();
        $forma = Forma::all();
        $dosagem = Dosagem::all();
        $pddlinha = PedidoLinha::where('pedido_id', $id)->get();

        return view('pedidosenviados_id' , compact('pddlinha','id','med','estado','estadopdd','dci','dosagem','forma'));
    }

    public function confirm($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado_pedido_id = 3;
        $pedido->save();

        $pddl = PedidoLinha::where('pedido_id', $id)->value('medicamento_id');
        $pddl2 = PedidoLinha::where('pedido_id', $id)->value('quantidade');

        $medch = MedicamentoPorCH::where('medicamento_id', $pddl)
            ->where('hospital_id', $pedido->hospital_id_origem)
            ->first();

        $medch->quantidade = $medch->quantidade + $pddl2;
        $medch->save();

        $hist = new Historico();
        $hist->medicamento_id = $pddl;
        $hist->hospital_id = $pedido->hospital_id_origem;
        $hist->quantidade = $medch->quantidade;
        $hist->save();

        $pedido2 = Pedido::find($id+1);
        $pedido2->estado_pedido_id = 3;
        $pedido2->save();

        $medch2 = MedicamentoPorCH::where('medicamento_id', $pddl)
            ->where('hospital_id', $pedido->hospital_id_destino)
            ->first();

        $medch2->quantidade = $medch2->quantidade - $pddl2;
        $medch2->save();

        $hist2 = new Historico();
        $hist2->medicamento_id = $pddl;
        $hist2->hospital_id = $pedido->hospital_id_destino;
        $hist2->quantidade = $medch2->quantidade;
        $hist2->save();

        return redirect('/pedidosenviados');
    }

    public function pedidosRecebidos()
    {
        $hospu = Auth::user()->hospital_id;

        $pddlinha = PedidoLinha::all();
        $med = Medicamento::all();
        $estado = Estado::all();
        $hosp = Hospital::all();
        $admin = Admin::all();
        $user = User::all();
        $estadopdd = EstadoPedido::all();
        $pdd = Pedido::where('tipo_id', 2)->where('hospital_id_destino', '=' , $hospu )->orderBy('id', 'desc')->paginate(10);

        return view('pedidosrecebidos', compact('pdd','pddlinha','med','estado','hosp', 'admin','user','estadopdd'));
    }

    public function pedidosRecebidosID($id)
    {
        $pddenv = Pedido::findOrFail($id);
        $createdpdd = $pddenv->created_at;

        $pddrec = Pedido::where('created_at', $createdpdd)->value('id');
        $pddlinha = PedidoLinha::where('pedido_id', $pddrec)->get();

        $med = Medicamento::all();
        $estado = Estado::all();
        $estadopdd = EstadoPedido::all();
        $dci = DCI::all();
        $forma = Forma::all();
        $dosagem = Dosagem::all();

        return view('pedidosrecebidos_id' , compact('pddlinha','id','med','estado','estadopdd','dci','dosagem','forma'));
    }

    public function confirmenvio($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado_pedido_id = 2;
        $pedido->save();


        $pdd2 = Pedido::findOrFail($id-1);
        $pdd2->estado_pedido_id = 2;
        $pdd2->save();


        return redirect('/pedidosrecebidos');

    }

    public function rejectenvio ($id)
    {

        $pedido = Pedido::findOrFail($id);
        $pedido->estado_pedido_id = 4;
        $pedido->save();

        $pdd2 = Pedido::findOrFail($id-1);
        $pdd2->estado_pedido_id = 4;
        $pdd2->save();
        return redirect('/pedidosrecebidos');

    }




}
