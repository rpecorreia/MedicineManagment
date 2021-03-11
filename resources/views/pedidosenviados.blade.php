@extends('layouts.backend')
@section('content')



    <h3> Lista de Pedidos Enviados:
        <br><br>
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

            <h5 class = "card-title">Exibindo {{$pdd->count()}} medicamentos de {{$pdd->total()}}
                ({{$pdd->firstItem()}} a {{$pdd->lastItem()}})</h5>




            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">Efetuado por</th>
                <th scope = "col">Centro Hospitalar</th>
                <th scope = "col">Urgência</th>
                <th scope = "col">Estado</th>
                <th scope = "col">Confirmar receção</th>


                </thead>
                <tbody>

                @foreach($pdd as $p)
                    <tr>

                        <td>{{$p->id}}</td>

                        @if($p->user_id == NULL)
                            @foreach($admin as $a)
                                @if($a->id === $p->admin_id)
                                    <td>{{$a->name}}</td>
                                @endif
                            @endforeach
                        @else
                            @foreach($user as $u)
                                @if($u->id === $p->user_id)
                                    <td>{{$u->name}}</td>
                                @endif
                            @endforeach
                        @endif



                        @foreach($hosp as $h)
                            @if($h->id === $p->hospital_id_destino)
                                <td>{{$h->name}}</td>
                            @endif
                        @endforeach

                        @foreach($estado as $e)
                            @if($e->id === $p->estado_id)
                                <td>{{$e->estado}}</td>
                            @endif
                        @endforeach

                        @foreach($estadopdd as $ep)
                            @if($ep->id === $p->estado_pedido_id)
                                <td class="d-none d-sm-table-cell">
                                    @if($p->estado_pedido_id === 1)
                                        <span class="badge badge-info">{{$ep->estado_pedido}}</span>
                                    @endif
                                    @if ($p->estado_pedido_id === 2)
                                        <span class="badge badge-warning">{{$ep->estado_pedido}}</span>
                                    @endif
                                    @if ($p->estado_pedido_id === 3)
                                        <span class="badge badge-success">{{$ep->estado_pedido}}</span>
                                    @endif
                                    @if ($p->estado_pedido_id === 4)
                                        <span class="badge badge-danger">{{$ep->estado_pedido}}</span>
                                    @endif

                                </td>
                            @endif
                        @endforeach

                        <form action="/pedidosenviados/confirm/{{$p->id}}" method="POST">
                            @csrf

                            <td>

                                @if($p->estado_pedido_id === 3 )

                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Confirmado" disabled="disabled">
                                        <i class = "fa fa-check-square"></i>

                                    </button>

                                @elseif($p->estado_pedido_id === 4 )
                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip"  disabled="disabled">
                                        <i class = "fa fa-check-square"></i>
                                    </button>

                                @else

                                    <button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Confirmar">
                                        <i class = "fa fa-check-square"></i>

                                    </button>

                                @endif

                            </td>

                            <td>

                                <button type="button" onclick="window.location.href ='/pedidosenviados/{{$p->id}}' ;" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Ver mais">
                                    Ver mais...

                                </button>
                            </td>
                        </form>


                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class = "card-footer">
            {{$pdd->links()}}
        </div>
    </div>
    <br><br>



@endsection

