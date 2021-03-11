@extends('layouts.backend')

@section('content')


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

        <form action="/listarmedlocal/{{$medch->id}}" method="POST">

            @csrf

            <div class="form-group">
                <div class="col-md-3">
                    <label for="qtdMed">Quantidade do Medicamento:</label>

                    <br><br>

                    <input type="number" min="0" class="form-control" name="qtdMed" id="qtdMed"
                           value="{{$medch->quantidade}}">
                    <br><br>


                    <button type="submit" class="btn btn-primary btn-sm">Inserir</button>
                    <button type="button" onclick="window.location.href = '/listarmedlocal';" class="btn btn-danger btn-sm">Cancelar</button>

                </div>

            </div>
        </form>
    </div>


@endsection
