@extends('layouts.simple')


@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/oneui.app.js"></script>
    <script src="/js/laravel.app.js"></script>

@endsection

@section('content')

    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo36@2x.jpg') }}');">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                         <span class="text-primary font-w300"></span> <span class="font-w300"> </span>
                    </h1>




                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>MedGest</title>
                    <head>
                    <meta name="description" content="">
                    <meta name="author" content="pixelcave">
                    <meta name="robots" content="noindex, nofollow">
                    <meta property="og:title" content="MedGest">
                    <meta property="og:site_name" content="MedGest">
                    <meta property="og:description" content="">
                    <meta property="og:type" content="website">
                    <meta property="og:url" content="">
                    <meta property="og:image" content="">
                    <link rel="shortcut icon" href="media/favicons/favicon.png">
                    <link rel="icon" type="image/png" sizes="192x192" href="media/favicons/favicon-192x192.png">
                    <link rel="apple-touch-icon" sizes="180x180" href="media/favicons/apple-touch-icon-180x180.png">
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
                    <link rel="stylesheet" id="css-main" href="css/oneui.css">
                    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-16158021-6', 'auto');ga('send', 'pageview');</script>
                    </head>


<div class="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo6@2x.jpg') }}');">
            <div class="hero-static bg-white-95">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-8 col-xl-5">
                            <div class="block block-themed block-fx-shadow mb-0">

                                <div class="block-header">
                                    <h3 class="block-title">{{ __('Login | Admin') }}</h3>
                                    <div class="block-options">



                                        @if (Route::has('password.request'))
                                            <a class="btn-block-option font-size-sm" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                         <!--
                                        <a class="btn-block-option" href="#" data-toggle="tooltip" data-placement="left" title="New Account">
                                            <i class="fa fa-user-plus"></i>
                                        </a> -->

                                    </div>
                                </div>

                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 py-lg-5">
                                        <a class="font-w600 text-dual">
                                            <i class="fa fa-circle-notch text-primary"></i>
                                            <span class="smini-hide">
                                                <span class="font-w700 font-size-h4">MedGest</span> <span class="font-w300"></span>
                                            </span>
                                        </a>
                                        <p>Por favor insira os seus dados de login. </p>

                                        <form class="js-validation-signin" method="POST" action="{{ route('admin.login') }}">
                                        @csrf
                                            <div class="py-3">

                                        <div class="form-group">
                                            <label for="email" class="col-md-6 col-form-label ">{{ __('Email') }}</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control form-control-alt form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="password" class="col-md-6 col-form-label ">{{ __('Password') }}</label>

                                            <div class="col-md-12 ">
                                                <input id="password" type="password" class="form-control form-control-alt form-control-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                       <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="custom-control-label font-w400" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>

                                            </div>
                                        </div> -->

                                            </div>

                                        <div class="form-group row mb-0 justify-content-md-center">
                                            <div class="col-md-6 col-xl-5">
                                                <button type="submit" class="btn btn-block btn-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i>
                                                    {{ __('Login') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <div class="content content-full font-size-sm text-muted text-center">
                                <strong>MedGest</strong> &copy; <span data-toggle="year-copy"></span>
                            </div>
                            <br>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
</div>
                </div>
            </div>
        </div>
    </div>







@endsection


