<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/citymarket.ico')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- NO CACHE --}}

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/1eda8b13cd.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
.navbar-header-custom{
    background-color: #FD5219 !important;
    box-shadow: 6px 5px 4px -6px rgba(0,0,0,0.5);
    
}
    .navbar-custom{
        width: 100%; 
        display:flex;
        background-color: #FD5219;
        padding: 0 30px;

    }
    .navbar-brand{
        color: white !important;
    }

    .nav-link{
        color: white !important;
    }
    .dropdown-menu{
        background-color: #FD5219;
    }
    .dropdown-item:hover{
        background-color: #FD5219;
        color: white;
    }
    .navbar-image-citymarket{
        width: 200px;

    }
    ul.navbar-nav:nth-child(1) > li:nth-child(1) {
    color: white;
    cursor: pointer;
    }
    .carousel-image{
        width: 386px;
        height: 525px;
        margin-left: auto;
        margin-right: auto;
    }
    .carousel-control-next-icon{
        background-image: url("{{asset('img/next.svg')}}")
    }
    .carousel-control-prev-icon{
        background-image: url("{{asset('img/previous.svg')}}")
    }
    .carousel-text{
        font-weight: bold;
        text-transform: uppercase;
    }
    .div-carousel-text{
        width: 100%;
        height: 50px;
    }
    .button-ayuda{
        background-color: #080096;
        color: white;
    }
    .button-ayuda:hover{
        color:white;
    }
    

</style>
<body style="box-sizing: border-box">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-header-custom">
            <div class="navbar-custom">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img class="navbar-image-citymarket" src="{{asset('img/cityplus2.png')}}" alt="citymarket" >
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav mr-auto">
                        <button type="button" class="btn button-ayuda" data-toggle="modal" data-target="#ModalAyuda">
                            <i class="fas fa-question"></i> Ayuda
                        </button>
                    </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle fa-1x"></i> {{ Auth::user()->user }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="ModalAyuda" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAyudaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalAyudaLabel">Ayuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <div class="div-carousel-text">
                                    <p  class="carousel-text">1. Abrir el cartón</p>
                                </div>
                                
                                <img src="{{asset('img/tapa_carton.png')}}" class="d-block carousel-image">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                            </div>
                            <div class="carousel-item text-center">
                               
                                <div class="div-carousel-text">
                                    <p class="carousel-text">2. Escanear los codigos que se encuentran en la esquina inferior izquierda e inferior derecha.</p>
                                </div>
                                <img src="{{asset('img/carton_interior.png')}}" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
            </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
