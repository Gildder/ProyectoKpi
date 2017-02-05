<!DOCTYPE html>
<html ng-app='angularRoutingApp'>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
  
  <!-- My style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/estilo.css')}}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{URL::asset('plugins/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/daterangepicker/daterangepicker.css')}}">  
  <!-- Datetables -->
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables/jquery.dataTables.min.css')}}">


<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js')}}"></script>-->

 <!-- Mi Datetables -->
<link rel="stylesheet" href="{{URL::asset('plugins/datatables/jquery.dataTables.min.css')}}">

<script src="{{URL::asset('dist/js/main.js')}}"></script>





  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="skin-blue sidebar-mini" >
<div class="wrapper">
    @if (Auth::user())
      @if (Auth::user()->type == 1)
        @include("partials/menus/menu_bar_admin")
      @else
        @include("partials/menus/menu_bar_standard")
      @endif
    @else
        @include("partials/menus/menu_bar_guess")
    @endif

  <!-- Content Wrapper. Contains page content -->
  
    <!-- Main content -->
    <section class="content-header">
          @yield('content-header')     
    </section>
    <section class="content">
          @if(session('success'))
            <div class="alert alert-success"> 
              {{session('success')}}
            </div>
          @endif

          @yield('content')     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
      
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!--
<script src="{{URL::asset('plugins/descargas/raphael-min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
-->
<script src="{{URL::asset('plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('plugins/descargas/moment.min.js')}}"></script>
<script src="{{URL::asset('plugins/moment/moment-with-locales.js')}}"></script>
<script src="{{URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{URL::asset('plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('dist/js/pages/dashboard.js')}}"></script>

<script>
  @yield('script')   
</script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('dist/js/demo.js')}}"></script>

</body>
</html>
