<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <header style="background: black; height: 60px;">
        <div class="titulo" style="display: inline-block; margin:10px;">
            <h1 style="margin: 0;">Laravel</h1>
        </div>
        <div class="login" style="display: inline-block; float: right; margin: 10px; ">
                
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <a type="button"  class="btn btn-primary" href="{{ url('/login') }}">Entrar</a>
                    <a type="button"  class="btn btn-success" href="{{ url('/register') }}">Register</a>
                    <a type="button"  class="btn btn-success" href="{{ url('/grupodepartamento') }}">Grupo</a>
                @else
                    <div  class="dropdown">
                        <a href="#" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesion</a></li>
                        </ul>
                    </div>
                @endif
    </header>
    
    @if (!Auth::guest())
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/home') }}">Tareas</a></li>
                <li><a href="{{ url('/home') }}">Proyectos</a></li>
                <li><a href="{{ url('/home') }}">Perfil</a></li>
                <li><a href="{{ url('/home') }}">General</a></li>
                <li><a href="{{ url('/grupodepartamentos/list') }}">Ubicaciones</a></li>
                <li><a href="{{ url('/home') }}">Empleados</a></li>
                <li><a href="{{ url('/home') }}">Tareas</a></li>
            </ul>
        </div>

        <div class="container" >
            <ul class="nav navbar-nav">
                
                <!-- Menu tareas-->
                <li><a href="#">Diarias</a></li>
                <li><a href="#">Programadas</a></li>
                <li><a href="#">Busquedas</a></li>
                <!-- Menu Proyectos-->
                <li><a href="#">Diarias</a></li>
                <li><a href="#">Programadas</a></li>
            </ul>
        </div>
    </nav>
    @endif

    <section style="background: white">
        @yield('content')
    </section>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
