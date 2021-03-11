@extends('layouts.backendadmin')

@section('content')
    <h3>Inserir medicamento no CH:
        <br><br>
        <small class="text-muted">{{__('|  Inserir novo medicamento:') }}</small>
    </h3>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <br>

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


                        <form method="POST" action="{{route('admin.storemed')}}">
                            @csrf

                            <div class="form-group">
                                <label for="DCIMedicamento">DCI do Medicamento:</label>
                                <select class="custom-select" name="DCIMedicamento" id="DCIMedicamento">
                                    @foreach($dci as $d)
                                        <option value="{{$d -> id}}">{{$d->DCI}}</option>
                                    @endforeach
                                </select>

                                <br><br>

                                <label for="DosagemMedicamento">Dosagem do Medicamento:</label>
                                <select class="custom-select" name="DosagemMedicamento" id="DosagemMedicamento">
                                    @foreach($dosagem as $d)
                                        <option value="{{$d -> id}}">{{$d->dosagem}}</option>
                                    @endforeach
                                </select>

                                <br><br>

                                <label for="FormaMedicamento">Forma do Medicamento:</label>
                                <select class="custom-select" name="FormaMedicamento" id="FormaMedicamento">
                                    @foreach($forma as $f)
                                        <option value="{{$f -> id}}">{{$f->forma}}</option>
                                    @endforeach
                                </select>

                                <br><br>

                                <label for="dataValidade">Data de validade:</label>
                                <input type="date" min="0" class="form-control" name="dataValidade" id="dataValidade"
                                       placeholder="Data de validade">

                                <br>

                                <label for="qtdMedicamento">Quantidade:</label>
                                <input type="number" min="0" class="form-control" name="qtdMedicamento" id="qtdMedicamento"
                                       placeholder="Quantidade">

                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Inserir') }}
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>
        <br><br>
        <small class="text-muted">{{__('|  Inserir Medicamento existente:') }}</small>
    </h3>

    <div class="card text-center">
        <div class="card-header">
        </div>

        <div class="card-body">
            <h5 class = "card-title">Exibindo {{$medicamentos->count()}} medicamentos de {{$medicamentos->total()}}
                ({{$medicamentos->firstItem()}} a {{$medicamentos->lastItem()}})</h5>

            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">DCI</th>
                <th scope = "col">Dosagem</th>
                <th scope = "col">Forma</th>
                <th scope = "col">Data de validade</th>

                </thead>
                <tbody>
                @foreach($medicamentos as $m)
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

                        <td>
                                <button type="button" onclick="window.location.href = '/admin/inserirmed/editar/{{$m->id}}';" class="btn btn-sm btn-light js-tooltip-enabled" data-toggle="tooltip" title="Inserir">
                                    <i class = "fa fa-plus-circle">
                                    </i>
                                </button>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class = "card-footer">
            {{$medicamentos->links()}}
        </div>
    </div>
    <br><br>



@endsection
