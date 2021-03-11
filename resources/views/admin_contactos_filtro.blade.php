@extends('layouts.backendadmin')
@section('content')


    <h3> Hospital {{$nome}}:
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


                <table class = "table table-hover table-vcenter">
                    <thead>
                    <th scope = "col">#</th>
                    <th scope = "col">Nome</th>
                    <th scope = "col">Email</th>
                    <th scope = "col">Telefone</th>

                    </thead>
                    <tbody>


                    @foreach($name as $n)
                        <tr>

                            <td>{{$n->id}}</td>
                            <td>{{$n->name}}</td>
                            <td>{{$n->email}}</td>
                            <td>{{$n->tlm}}</td>

                        </tr>

                    @endforeach

                    </tbody>



                </table>

            <br><br>



        </div>

    </div>
    <br>
    <div class = "col-sm-3">
        <button type="button" onclick="window.location.href = '/admin/contactos';" class="btn btn-secondary btn-sm">
            <i class = "fa fa-angle-left"></i>
            Voltar</button>
    </div>



@endsection


