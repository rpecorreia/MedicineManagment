<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DCI;
use App\Dosagem;
use App\Estado;
use App\EstadoPedido;
use App\EstadoUser;
use App\Forma;
use App\Historico;
use App\Hospital;
use App\Medicamento;
use App\MedicamentoPorCH;
use App\Pedido;
use App\PedidoLinha;
use App\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers;


class AdminControlador extends Controller
{
    //vai aceder à autenticação no middleware, e se der tudo certo é que vai ter ao dashboard

    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function settings() {
        return view('admin_settings', ['user' => Auth::user()]);
    }

    public function edituser($id) {
        $user = User::find($id);
        $hosp = Hospital::all();
        $estado = EstadoUser::all();
        return view('admin_editarconta', compact('user', 'hosp','estado'));
    }

    public function updateuser($id, Request $request) {
        $u = User::findorFail($id);

            if (isset($u)) {
                    $u->name = $request->input('name');
                    $u->email = $request->input('email');
                    $u->hospital_id = $request->input('hospital');
                    $u->estado_id = $request->input('estado_id');
                    $u->save();
                    return redirect('/admin/contaslistar')->with("success", "Dados atualizados com sucesso!");

                }
            }

/*
    public function destroyuser($id) {
        $u = User::findorFail($id);

        if(isset($u)) {
            $u->delete();
            return redirect('/admin/contaslistar')->with("success", "Utilizador removido com sucesso!");
        }

    }
*/

    //inserir um novo medicamento
    public function inserirNovoMed()
    {    $dci = DCI::all();
        $dosagem = Dosagem::all();
        $forma = Forma::all();
        $med = Medicamento::all();


        return view('admin_inserirmed',  compact('dci','dosagem', 'forma','med'));
    }

    //inserir um medicamento existente
    public function inserirMedExistente()
    {
        $m = Medicamento::all();
        $medicamentos = Medicamento::paginate(10);
        $dci = DCI::all();
        $dosagem = Dosagem::all();
        $forma = Forma::all();

        return view('admin_inserirmed',  compact(  'medicamentos', 'dci', 'dosagem', 'forma','m'));
    }


    public function editMedExistente($id)
{

    $med = Medicamento::find($id);
    if(isset($med)) {
        return view ('admin_editarmed', compact('med'));
    }

    return redirect()->back();
}


    public function update(Request $request, $id)
    {
        $med = Medicamento::find($id);
        $medch = new MedicamentoPorCH();
        $mc = MedicamentoPorCH::all();
        $hist = new Historico();

        if(isset($med)) {
            $medch->medicamento_id = $med->id;
            $medch->hospital_id = Auth::user()->hospital_id;
            $medch->quantidade = $request->input('qtdMed');

            foreach ($mc as $m){
                if(($medch->medicamento_id === $m->medicamento_id) && ($medch->hospital_id === $m->hospital_id )){
                    return redirect()->back()->with("error","Esse medicamento já existe no seu CH!");
                }
            }

            $medch->save();

            $hist->medicamento_id = $med->id;
            $hist->hospital_id = $medch->hospital_id;
            $hist->quantidade = $medch->quantidade;
            $hist->save();

        }

        return redirect('/admin/inserirmed')->with("success", "Medicamento inserido com sucesso!");
    }


    public function storeMed(Request $request)
    {
        $medporch =MedicamentoPorCH::all();
        $mm= Medicamento::all();
        $med = new Medicamento();
        $medch = new MedicamentoPorCH();
        $hist = new Historico();

        $med->DCI_id = $request->input('DCIMedicamento');
        $med->dosagem_id = $request->input('DosagemMedicamento');
        $med->forma_id = $request->input('FormaMedicamento');
        $med->data_validade = $request->input('dataValidade');

        if(!isset($med->data_validade)) {
            return redirect()->back()->with("error","Por favor, insira uma data de validade!");
        }

        foreach ($mm as $m) {
            if (($med->DCI_id === $m->DCI_id) && ($med->dosagem_id === $m->dosagem_id) && ($med->forma_id === $m->forma_id) && ($med->data_validade === $m->data_validade)) {
                return redirect()->back()->with("error", "Medicamento já existente!");
            }
        }

        $med->save();

        $medch->medicamento_id = $med->id;
        $hospid = Auth::user()->hospital_id;
        $medch->hospital_id = $hospid;
        $medch->quantidade = $request->input('qtdMedicamento');

        if(!isset($medch->quantidade)){
            return redirect()->back()->with("error","Por favor, insira a quantidade!");
        }

        foreach ($medporch as $mec){
            if(($medch->medicamento_id === $mec->medicamento_id) && ($medch->hospital_id === $mec->hospital_id ) && ($medch->quantidade === $mec->quantidade)){
                return redirect()->back()->with("error","Esse medicamento já existe no seu CH!");
            }
        }

        $medch->save();

        $hist->medicamento_id = $med->id;
        $hist->hospital_id = $medch->hospital_id ;
        $hist->quantidade = $medch->quantidade;
        $hist->save();

        return redirect()->back()->with("success","Novo medicamento adicionado com sucesso!");
    }


    //ver lista de medicamentos locais

    public function listarMedLocal()
    {
        $dci = DCI::all();
        $dosagem = Dosagem::all();
        $forma = Forma::all();
        $medch = MedicamentoPorCH::all();
        $med = Medicamento::all();
        $x = Auth::user()->hospital_id;
        $contagem = MedicamentoPorCH::where('hospital_id', $x)->paginate(5);

        return view('admin_listarmedlocal', compact('medch', 'med', 'dci', 'dosagem', 'forma', 'contagem'));
    }

    //apagar um med local

    public function destroy($id)
    {
        $medch= MedicamentoPorCH::find($id);
        if (isset($medch)) {
            $medch->delete();
        }

        return redirect ('/admin/listarmedlocal');
    }


    public function editMedLocal($id)
    {
        $medch = MedicamentoPorCH::find($id);

        if(isset($medch)) {
            return view ('admin_editarmedlocal', compact('medch'));
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

        return redirect('/admin/listarmedlocal')->with("success", "Quantidade atualizada com sucesso!");
    }




    //ver lista de medicamentos globais

    public function listarMedGlobal()
    {
        $med = Medicamento::paginate(10);
        $dci = DCI::all();
        $forma = Forma::all();
        $dosagem = Dosagem::all();
        return view('admin_listarmedglobal', compact('med', 'dci','forma','dosagem'));
    }



    //fazer um pedido

    public function fazerPedido()
    {
        $hosp = Hospital::all();
        $estado = Estado::all();
        $med= Medicamento::paginate(10);
        $dci= DCI::all();
        $forma= Forma::all();
        $dosagem = Dosagem::all();
        $selectedMed = Medicamento::first()->id;

        return view('admin_fazerpedido', compact('hosp', 'estado','med', 'dci','forma','dosagem','selectedMed'));

    }

    public function store(Request $request)
    {
        $idmed = $request->get('idMed');
        $hospital = $request->get('wizard-progress2-hospital');
        $estado = $request->get('wizard-progress2-estado');
        $quantidade = $request->get('qtdMed');

        $find = Medicamento::find($idmed);

        if(isset($find)) {

        $pedido1 = new Pedido();
        $pedidolinha = new PedidoLinha();
        $pedido2 = new Pedido();

        $pedido1->admin_id = Auth::user()->id;
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

         $pedido2->admin_id = Auth::user()->id;
         $pedido2->estado_id = $estado;
         $pedido2->tipo_id = 2;
         $pedido2->hospital_id_origem = Auth::user()->hospital_id;
         $pedido2->hospital_id_destino = $hospital;
         $pedido2->estado_pedido_id = 1;
         $pedido2->save();

         }

         else{
             return redirect('/admin/fazerpedido')->with("error", "Esse ID não existe. Por favor escolha um ID válido!");

         }

        return redirect('/admin/fazerpedido')->with("success", "Pedido enviado com sucesso!");

    }

    //ver pedidos enviados

    public function pedidosEnviados()
    {
        $hospa = Auth::user()->hospital_id;

        $admin = Admin::all();
        $user = User::all();

        $pdd = Pedido::where('tipo_id', 1)->where('hospital_id_origem', '=' , $hospa )->orderBy('id', 'desc')->paginate(10);

        $pddlinha = PedidoLinha::all();
        $med = Medicamento::all();
        $estado = Estado::all();
        $hosp = Hospital::all();

        $estadopdd = EstadoPedido::all();


        return view('admin_pedidosenviados', compact('pdd','pddlinha','med','estado','hosp', 'admin','user','estadopdd'));

    }

    public function pedidosEnviadosID($id)
    {
            $pddlinha = PedidoLinha::where('pedido_id', $id)->get();

            $med = Medicamento::all();
            $estado = Estado::all();
            $estadopdd = EstadoPedido::all();
            $dci = DCI::all();
            $forma = Forma::all();
            $dosagem = Dosagem::all();

            return view('admin_pedidosenviados_id' , compact('pddlinha','id','med','estado','estadopdd','dci','dosagem','forma'));

    }

    public function confirm($id)
    {

        $pedido = Pedido::find($id);
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




        return redirect('/admin/pedidosenviados');

    }

    //ver pedidos recebidos

    public function pedidosRecebidos()
    {
        $hospa = Auth::user()->hospital_id;
        $pdd = Pedido::where('tipo_id', 2)->where('hospital_id_destino', '=' , $hospa )->orderBy('id', 'desc')->paginate(10);


        $pddlinha = PedidoLinha::all();
        $med = Medicamento::all();
        $estado = Estado::all();
        $hosp = Hospital::all();
        $admin = Admin::all();
        $user = User::all();
        $estadopdd = EstadoPedido::all();


        return view('admin_pedidosrecebidos', compact('pdd','pddlinha','med','estado','hosp', 'admin','user','estadopdd'));

    }

    public function pedidosRecebidosID($id)
    {
        $pddenv = Pedido::find($id);
        $createdpdd = $pddenv->created_at;

        $pddrec = Pedido::where('created_at', $createdpdd)->value('id');

        $pddlinha = PedidoLinha::where('pedido_id', $pddrec)->get();

        $med = Medicamento::all();
        $estado = Estado::all();
        $estadopdd = EstadoPedido::all();
        $dci = DCI::all();
        $forma = Forma::all();
        $dosagem = Dosagem::all();

        return view('admin_pedidosrecebidos_id' , compact('pddlinha','id','med','estado','estadopdd','dci','dosagem','forma'));

    }

    public function confirmenvio($id)
    {

        $pedido = Pedido::find($id);
        $pedido->estado_pedido_id = 2;
        $pedido->save();


        $pdd2 = Pedido::find($id-1);
        $pdd2->estado_pedido_id = 2;
        $pdd2->save();


        return redirect('/admin/pedidosrecebidos');

    }

    public function rejectenvio ($id)
    {

        $pedido = Pedido::find($id);
        $pedido->estado_pedido_id = 4;
        $pedido->save();

        $pdd2 = Pedido::find($id-1);
        $pdd2->estado_pedido_id = 4;
        $pdd2->save();

        return redirect('/admin/pedidosrecebidos');

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


        return view('admin_movimentos', compact('hist', 'med', 'pesquisadci', 'dosagem', 'forma', 'contagem', 'dci'));

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



        return view('admin_movimento_filtro', compact('contagem','med', 'id2','dci_name', 'name','dci','dcinome'));


    }

    public function contactos() {
        $hosp = Hospital::paginate(10);

        return view('admin_contactos', compact('hosp'));

    }

    public function contactosFiltro (Request $request) {

        $hosp_name = $request->input('hosp');

        $name = Hospital::where('name', 'LIKE', '%'.$hosp_name.'%')->get();
        $nome = Hospital::where('name', 'LIKE', '%'.$hosp_name.'%')->value('name');



        return view('admin_contactos_filtro', compact('name','nome'));


    }



    //mudar dados da conta
    public function changePassword(Request $request){

        // Get current user
        $userId = Auth::id();
        $user = Admin::findOrFail($userId);


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
        return redirect()->back()->with("success","As definições foram alteradas com sucesso!");
    }



}
