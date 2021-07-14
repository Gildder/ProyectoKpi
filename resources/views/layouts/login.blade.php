<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('titulo')</title>
    
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/font-awesome.min.css')}}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
    
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{URL::asset('plugins/jQueryUI/jquery-ui.css')}}">
    
    <!-- My style -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/app.css')}}">
    
    <!-- jQuery 2.2.3 -->
    <script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    
</head>
<body class="hold-transition skin-yellow sidebar-mini"  >
<div class="wrapper" style="width:100%; height:100%;">

    @include("partials/menus/menu_bar_guess")
    
    {{-- Div Notificacion --}}
    <div id="notificacion"></div>
    
    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
    
    
</div>
</body>
</html>
