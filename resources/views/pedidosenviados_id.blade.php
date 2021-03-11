@extends('layouts.backend')

@section('content')

    <h3> Lista de Pedidos Enviados:
        <br><br>
        <small class="text-muted">{{__('|  Detalhes do pedido') }} {{$id}} {{':'}}</small>
    </h3>

    <div class="card text-center">
        <div class="card-header">
        </div>

        <div class="card-body">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">DCI</th>
                <th scope = "col">Dosagem</th>
                <th scope = "col">Forma</th>
                <th scope = "col">Data de validade</th>
                <th scope = "col">Quantidade</th>
                <th scope = "col">Data/hora</th>
                </thead>
                <tbody>

                @foreach($pddlinha as $p)
                    <tr>
                        @foreach($med as $m)
                            @if($m->id === $p->medicamento_id)
                                <td>{{$m->id}}</td>
                            @endif

                            @foreach($dci as $d)
                                @if($d->id === $m->DCI_id && $m->id === $p->medicamento_id)
                                    <td>{{$d->DCI}}</td>
                                @endif
                            @endforeach

                            @foreach($dosagem as $d)
                                @if($d->id === $m->dosagem_id && $m->id === $p->medicamento_id )
                                    <td>{{$d->dosagem}}</td>
                                @endif
                            @endforeach

                            @foreach($forma as $f)
                                @if($f->id === $m->forma_id && $m->id === $p->medicamento_id)
                                    <td>{{$f->forma}}</td>
                                @endif
                            @endforeach

                            @if($m->id === $p->medicamento_id)
                                <td>{{$m->data_validade}}</td>
                            @endif

                        @endforeach

                        <td>{{$p->quantidade}}</td>
                        <td>{{$p->created_at}}</td>


                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <br><br>

    <div class = "col-sm-3">
        <button type="button" onclick="window.location.href = '/pedidosenviados';" class="btn btn-secondary btn-sm">
            <i class = "fa fa-angle-left"></i>
            Voltar</button>
    </div>


    <br><br>




@endsection