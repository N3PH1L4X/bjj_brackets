<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon.ico') }}">
    <title>Inicio</title>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" type="text/css">
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/html2pdf.bundle.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



    <script src="{{ asset('/js/highcharts.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</head>
<body>
    <div class="header">

        <nav class="navbar1">
            <div class="container">
                <a href="{{-- url('/dashboard') --}}">Inicio</a>
                @if(session('user_id'))
                    <div class="nombreusuario">
                        <p>¡Hola, {{ session('nombre') }}!</p>
                    </div>
                @endif
            </div>
        </nav>

        <nav class="navbar2">
            <div class="imagen">
                <a href="{{-- url('/dashboard') --}}"><img src="{{ asset('/img/logo.png') }}" alt="Logo"></a>
            </div>
            <div class="opciones">
                <ul>
                    <li><a href="{{-- url('/dashboard') --}}">Inicio</a></li>
                    <li>
                        <div class="dropdown">
                            <a class="dropbtn">Herramientas</a>
                            <div class="dropdown-content" style="z-index: 999999999999999999999999">
                                <a href="{{ url('/eventos') }}">Registro de eventos</a>
                                <a href="{{ url('/competidores') }}">Lista de competidores</a>
                                <a href="{{ url('/instructores') }}">Instructores</a>
                                <a href="{{ url('/escuelas') }}">Escuelas</a>
                                <a href="{{ url('/deportesycategorias') }}">Deportes y categorias</a>
                                <a href="{{ url('/inscripciones') }}">Inscripciones</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="{{-- url('/ayuda') --}}">Ayuda</a></li>
                    <li><a href="{{-- url('/login') --}}">Salir</a></li>
                </ul>
            </div>
        </nav>

    </div>
