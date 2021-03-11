@extends('layouts.backend')

@section('content')


    <h3>Fazer um pedido:
        <br><br>
        <small class="text-muted">{{__('|  Inserir novo pedido:') }}</small>
    </h3>
    <br>

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

    <div class="js-wizard-simple block block ">

        <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#wizard-progress2-step1" data-toggle="tab">1. Pedido</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#wizard-progress2-step2" data-toggle="tab">2. Medicamento</a>
            </li>

        </ul>
        <form action="{{route('storepedido')}}" method="POST">
            @csrf

            <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">

                <div class="tab-pane active" id="wizard-progress2-step1" role="tabpanel">

                    <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="wizard-progress2-hospital">Centro Hospitalar de destino:</label>
                        <select class="form-control form-control-alt" id="wizard-progress2-hospital" name="wizard-progress2-hospital">
                            @foreach($hosp as $h)
                                @if(Auth::user()->hospital_id != $h->id)
                                    <option value="{{$h -> id}}">{{$h->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="wizard-progress2-estado">Estado de urgência:</label>
                        <select class="form-control form-control-alt" id="wizard-progress2-estado" name="wizard-progress2-estado">
                            @foreach($estado as $e)
                                <option value="{{$e -> id}}">{{$e->estado}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="tab-pane" id="wizard-progress2-step2" role="tabpanel">

                    <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>

                    <div class="form-group">


                        <label for="wizard-progress2-bio"></label>

                        <table class = "table table-hover table-vcenter">
                            <thead>
                            <th scope = "col">#</th>
                            <th scope = "col">DCI</th>
                            <th scope = "col">Dosagem</th>
                            <th scope = "col">Forma</th>

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


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class = "card-footer">
                        {{$med->links()}}
                    </div>
                    <br>

                    <div class="form-group col-md-3">
                        <label for="wizard-progress2-estado">ID do medicamento:</label>
                        <input type="number" min="1" class="form-control" name="idMed" id="idMed">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="wizard-progress2-estado">Quantidade:</label>
                        <input type="number" min="1" class="form-control" name="qtdMed" id="qtdMed">
                    </div>

                </div>


            </div>



            <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                <div class="row">


                    <div class="col-6 text-right">


                        <button type="submit" class="btn btn-primary" data-wizard="finish">
                            <i class="fa fa-check mr-1"></i> Submit
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection




