@extends('layouts.backend')

@section('content')


    <h3> Lista de contactos:
        <br><br>
    </h3>

    <div class="card text-center">
        <div class="card-header">
        </div>

        <div class="card-body">

            <div class="col-md-3 col-lg-6">

            <form action="{{route('contactosFiltro')}}" method="POST">
                {{ csrf_field() }}

                <div class="input-group col-md-12">
                    <label for="searchHosp">Insira o nome do Centro Hospitalar:</label>
                    <input type="search" min="0" class="form-control" name="hosp" id="hosp"
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


            <h5 class = "card-title">Exibindo {{$hosp->count()}} CH de {{$hosp->total()}}
                ({{$hosp->firstItem()}} a {{$hosp->lastItem()}})</h5>


            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">#</th>
                <th scope = "col">Nome</th>
                <th scope = "col">Email</th>
                <th scope = "col">Telefone</th>

                </thead>
                <tbody>

                @foreach($hosp as $h)
                    <tr>
                        <td>{{$h->id}}</td>
                        <td>{{$h->name}}</td>
                        <td>{{$h->email}}</td>
                        <td>{{$h->tlm}}</td>

                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class = "card-footer">
            {{$hosp->links()}}
        </div>
    </div>
    <br><br>


@endsection