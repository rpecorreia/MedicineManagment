@extends('layouts.backendadmin')
@section('content')

    <h3> Lista Global de Medicamentos:
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

            <h5 class = "card-title">Exibindo {{$med->count()}} medicamentos de {{$med->total()}}
                ({{$med->firstItem()}} a {{$med->lastItem()}})</h5>


            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">DCI</th>
                <th scope = "col">Dosagem</th>
                <th scope = "col">Forma</th>
                <th scope = "col">Data de validade</th>

                </thead>
                <tbody>

                @foreach($med as $m)
                    <tr>
                        <td>{{$m->id}}</td>

                        @foreach($dci as $d)
                            @if ($d->id === $m->DCI_id)
                                <td>{{$d->DCI}}</td>
                            @endif
                        @endforeach

                        @foreach($dosagem as $d)
                            @if ($d->id === $m->dosagem_id)
                                <td>{{$d->dosagem}}</td>
                            @endif
                        @endforeach

                        @foreach($forma as $f)
                            @if ($f->id === $m->forma_id)
                                <td>{{$f->forma}}</td>
                            @endif
                        @endforeach
                        <td>{{$m->data_validade}}</td>


                         </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class = "card-footer">
            {{$med->links()}}
        </div>
    </div>
    <br><br>


@endsection




