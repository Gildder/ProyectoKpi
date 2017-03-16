<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $__env->yieldContent('titulo'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/AdminLTE.css')); ?>">
  
  <!-- My style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/estilo.css')); ?>">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/skins/_all-skins.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/iCheck/flat/blue.css')); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/morris/morris.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/datepicker/datepicker3.css')); ?>"> 
  <!-- Time Picker -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/daterangepicker/daterangepicker.css')); ?>">  
  <!-- Datetables -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/jQueryUI/jquery-ui.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/jQueryUI/jquery-ui-12.css')); ?>">



<!-- jQuery 1.8.23 -->
<script src="<?php echo e(URL::asset('plugins/jQuery/jquery-ui-1.8.23.custom.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jQuery/jquery-1.8.0.min.js')); ?>"></script>

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(URL::asset('plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jQuery/jquery-1.12.4.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(URL::asset('plugins/jQueryUI/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jQueryUI/jquery-ui.1.12.1.js')); ?>"></script>
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js')}}"></script>-->

 <!-- Mi Datetables -->
<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.css')); ?>">

<script src="<?php echo e(URL::asset('dist/js/main.js')); ?>"></script>

</head>
<body class="hold-transition skin-yellow sidebar-mini"  style="background: #ECF0F5;" >


<?php if(! Auth::guest()): ?>
  <div class="wrapper">
      <?php if(Auth::user()->isAdmin()): ?>
        <?php echo $__env->make("partials/menus/menu_bar_admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php else: ?>
        <?php echo $__env->make("partials/menus/menu_bar_standard", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>
<?php endif; ?>
  
    <!-- Main content -->
    <section class="content">
          <?php if(session('success')): ?>
            <div class="alert alert-success"> 
              <?php echo e(session('success')); ?>

            </div>
          <?php endif; ?>

          <?php echo $__env->yieldContent('content'); ?>     
    </section>
    <!-- /.content -->
      
</div>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(URL::asset('bootstrap/js/bootstrap.min.js')); ?>"></script>

<!-- Google ChartJS -->
<script src="<?php echo e(URL::asset('/plugins/GoogleChart/loader.js')); ?>"></script>

<script src="<?php echo e(URL::asset('plugins/descargas/raphael-min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="<?php echo e(URL::asset('plugins/morris/morris.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(URL::asset('plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(URL::asset('plugins/knob/jquery.knob.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(URL::asset('plugins/descargas/moment.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/moment/moment-with-locales.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- datepicker -->
<?php /* <script src="<?php echo e(URL::asset('plugins/datepicker/bootstrap-datepicker-es.js')); ?>"></script> */ ?>
<script src="<?php echo e(URL::asset('plugins/datepicker/datepicker-es.js')); ?>"></script>
<!-- timepicker -->
<script src="<?php echo e(URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo e(URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(URL::asset('plugins/fastclick/fastclick.js')); ?>"></script>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo e(URL::asset('plugins/chartjs/Chart.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(URL::asset('dist/js/app.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(URL::asset('dist/js/pages/dashboard.js')); ?>"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(URL::asset('dist/js/demo.js')); ?>"></script>


</body>
</html>
