@extends('layouts.backend')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/meucss.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick-theme.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function(){ One.helpers('slick'); });</script>
    <script>
        $('.autoplay').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
        });

    </script>

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <!-- Info -->
                <h3 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                    Dashboard <span class="text-primary font-w300">| Área de Farmacêutico</span>
                </h3>
                <!-- END Info -->

                <!-- Slider with dots -->
                <div class="block">
                    <div class="js-slider autoplay ">
                        <div>
                            <img class="" src="{{ asset('media/photos/2.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/1.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/3.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/4.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/5.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/6.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="" src="{{ asset('media/photos/7.jpg')}}" alt="photo">
                        </div>

                    </div>

                    <!-- END Slider with dots -->
                </div>
                <!-- END Dots -->
            </div>

        </div>
    </div>
    <!-- END Page Content -->
@endsection






