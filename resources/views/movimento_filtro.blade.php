@extends('layouts.backend')
@section('content')


    <h3> Histórico de Medicamentos:
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



             <!--  <h5 class = "card-title">Exibindo {{$contagem->count()}} medicamentos de {{$contagem->total()}}
                    ({{$contagem->firstItem()}} a {{$contagem->lastItem()}})</h5> -->

                <table class = "table table-hover table-vcenter">
                    <thead>
                    <th scope = "col">#</th>
                    <th scope = "col">DCI</th>
                    <th scope = "col">Quantidade</th>
                    <th scope = "col">Atualização</th>

                    </thead>
                    <tbody>


                    @foreach($contagem as $mc)
                        <tr>

                        @foreach($med as $m)

                            @if($m->id === $mc->medicamento_id)
                                <td>{{$m->id}}</td>
                            @endif

                            @foreach($dci as $d)
                                @if($m->id === $mc->medicamento_id && $m->DCI_id === $d->id)
                                 <td>{{$dcinome}}</td>
                                    @endif
                            @endforeach

                            @if($m->id === $mc->medicamento_id)
                                 <td>{{$mc->quantidade}}</td>
                            @endif

                            @if($m->id === $mc->medicamento_id)
                                    <td>{{$mc->updated_at}}</td>
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
    <div class = "col-sm-3">
        <button type="button" onclick="window.location.href = '/movimentos';" class="btn btn-secondary btn-sm">
            <i class = "fa fa-angle-left"></i>
            Voltar</button>
    </div>



@endsection


