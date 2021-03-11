@extends('layouts.backendadmin')

@section('content')

    <h3>Editar conta:
        <br><br>
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

                        <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nome:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" value="{{$user->name}}" name="name" >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email:</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" value="{{$user->email}}" name="email" >

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('estado_id') ? ' has-error' : '' }}">
                                <label for="hospital" class="col-md-4 control-label">Estado:</label>

                                <div class="col-md-6">
                                    <select id="estado_id" type="text" class="form-control" value="{{$user->estado_id}}" name="estado_id">
                                        @foreach($estado as $e)
                                            <option value="{{$e->id}}">{{$e->estado}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('estado_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('estado_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('hospital_id') ? ' has-error' : '' }}">
                                <label for="hospital" class="col-md-4 control-label">Centro Hospitalar:</label>

                                <div class="col-md-6">
                                    <select id="hospital" type="text" class="form-control" value="{{$user->hospital_id}}" name="hospital">
                                        @foreach($hosp as $h)
                                            <option value="{{$h->id}}">{{$h->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('hospital_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <br><br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection