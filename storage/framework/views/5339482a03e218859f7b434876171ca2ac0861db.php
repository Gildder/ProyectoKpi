<?php $__env->startSection('titulo'); ?>
  Tareas Programadas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Programadas</p>
  </div>

  <div class="panel-body">

    <?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <?php /* Opciones de Menu */ ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="<?php echo e(route('tareas.tareaProgramadas.create')); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
        
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >
        <?php /* Finalizado */ ?>
        <a  href="<?php echo e(route('tareas.tareaProgramadas.archivados')); ?>" class="btn btn-success btn-sm" ><span class="fa  fa-archive" title="Archivados"></span><b></b></a>
        <?php /* Eliminados */ ?>
        <a  href="<?php echo e(route('tareas.tareaProgramadas.eliminados')); ?>" class="btn btn-danger  btn-sm" ><span class="fa fa-trash" title="Eliminados">  </span><b></b></a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12" ><small>Semana <?php echo e($semanas[0]['semana']); ?> del mes de <?php echo e(nombreMes($semanas[0]['mes'])); ?>, del <b><?php echo e(cambiarFormatoEuropeo($semanas[0]['fechaInicio'])); ?></b> al <b><?php echo e(cambiarFormatoEuropeo($semanas[0]['fechaFin'])); ?></b></small>
              </div>
          <hr/>
        <?php echo $__env->make('tareas/tareaProgramadas/partials/tabla_tareaProgramadas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php

  function cambiarFormatoEuropeo($fecha)
    {    
        $partes=explode('-',$fecha);//se parte la fecha
        $fecha=$partes[2].'/'.$partes[1].'/'.$partes[0];//se cambia para que quede formato d-m-Y
        return $fecha;
    }  

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y 
     * 
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    function cambiarFormatoDB($fecha)
    {    
        $partes=explode('/',$fecha);//se parte la fecha
        $fecha=$partes[2].'-'.$partes[1].'-'.$partes[0];//se cambia para que quede formato d-m-Y

        return $fecha;
    }  


  function nombreMes($nro)
  {
    $mes = 'mes';
    switch($nro)
    {

      case '1':
        $mes = 'Enero';
        break;
      case '2':
        $mes = 'Febrero';
        break;
      case '3':
        $mes = 'Marzo';
        break;
      case '4':
        $mes = 'Abril';
        break;
      case '5':
        $mes = 'Mayo';
        break;
      case '6':
        $mes = 'Junio';
        break;
      case '7':
        $mes = 'Julio';
        break;
      case '8':
        $mes = 'Agosto';
        break;
      case '9':
        $mes = 'Septiembre';
        break;
      case '10':
        $mes = 'Octubre';
        break;
      case '11':
        $mes = 'Noviembre';
        break;
      case '12':
        $mes = 'Diciembre';
        break;

    }
    return $mes;
  }
?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>