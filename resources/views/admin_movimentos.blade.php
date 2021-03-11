@extends('layouts.backendadmin')
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



                <div class="col-md-3 col-lg-6">
                    <form action="{{route('admin.movimentosFiltro')}}" method="POST">
                    {{ csrf_field() }}

                    <div class="input-group col-md-12">
                    <label for="searchMed">Insira o DCI do Medicamento: </label>
                    <input type="search" min="0" class="form-control" name="DCI" id="DCI"
                       value="">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-sm" title="Pesquisar">
                                 <i class = "fa fa-search"></i>
                            </button>
                        </span>
                      </div>
                    </form>
              </div>

                <br><br>



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


