@extends('layouts.backendadmin')

@section('content')
    <h3>Criar conta:
        <br><br>
        <small class="text-muted">{{__('|  Registar Farmacêutico:') }}</small>
    </h3>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <br>



                    <div class="card-body">
                        <form method="POST" action="{{route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="hospital_id" class="col-md-4 col-form-label text-md-right" >{{ __('Centro Hospitalar') }}</label>
                                <div class="col-md-6">

                                <select class="custom-select" name="hospital_id" id="hospital_id">
                                    @foreach($hosp as $h)
                                        <option value="{{$h -> id}}">{{$h->name}}</option>
                                    @endforeach
                                </select>

                                    @if ($errors->has('hospital_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hospital_id" class="col-md-4 col-form-label text-md-right" >{{ __('Estado') }}</label>
                                <div class="col-md-6">

                                    <select class="custom-select" name="estado_id" id="estado_id">
                                        @foreach($estado as $e)
                                            <option value="{{$e -> id}}">{{$e->estado}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('estado_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estado_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Palavra-passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar palavra-passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registar') }}
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



