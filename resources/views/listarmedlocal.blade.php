@extends('layouts.backend')

@section('content')

    <h3> Lista Local de Medicamentos:
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

            <h5 class = "card-title">Exibindo {{$contagem->count()}} medicamentos de {{$contagem->total()}}
                ({{$contagem->firstItem()}} a {{$contagem->lastItem()}})</h5>

            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">DCI</th>
                <th scope = "col">Dosagem</th>
                <th scope = "col">Forma</th>
                <th scope = "col">Data de validade</th>
                <th scope = "col">Quantidade</th>

                </thead>
                <tbody>

                @foreach($contagem as $mc)
                    <tr>

                        @foreach($med as $m)

                            @if($m->id === $mc->medicamento_id)
                                <td>{{$m->id}}</td>
                            @endif


                            @foreach($dci as $d)

                                @if($d->id === $m->DCI_id && $m->id === $mc->medicamento_id)
                                    <td>{{$d->DCI}}</td>
                                @endif
                            @endforeach

                            @foreach($dosagem as $d)
                                @if($d->id === $m->dosagem_id && $m->id === $mc->medicamento_id)
                                    <td>{{$d->dosagem}}</td>
                                @endif
                            @endforeach

                            @foreach($forma as $f)
                                @if($f->id === $m->forma_id && $m->id === $mc->medicamento_id)
                                    <td>{{$f->forma}}</td>
                                @endif
                            @endforeach

                            @if($m->id === $mc->medicamento_id)
                                <td>{{$m->data_validade}}</td>
                            @endif

                            @if($m->id === $mc->medicamento_id)
                                <td>{{$mc->quantidade}}</td>
                            @endif

                            @if($m->id === $mc->medicamento_id)

                            <!-- <td>
                                <button type="button" onclick="window.location.href ='/admin/listarmedlocal/apagar/{{$mc->id}}' ;" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Eliminar">
                                    <i class = "fa fa-window-close">
                                    </i>
                                </button>
                            </td> -->

                                <td>
                                    <button type="button" onclick="window.location.href ='/listarmedlocal/editar/{{$mc->id}}' ;" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Editar quantidade">
                                        <i class = "fa fa-edit">
                                        </i>
                                    </button>
                                </td>

                            @endif
                        @endforeach



                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class = "card-footer">
            {{$contagem->links()}}
        </div>
    </div>
    <br><br>


@endsection




