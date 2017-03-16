 <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="margin-left: 0px;">
    
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>PI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>KPI</span>
    </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <?php if( Cache::get('evadores')): ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          <a href="<?php echo e(url('evaluadores/evaluados')); ?>" >
              <i class="fa fa-bullseye"></i>
              <label for="Tareas" class="hidden-xs">Evaluadores</label>
            </a>
          </li>
          <?php endif; ?>

          <?php if( Cache::get('depasores')): ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          <a href="<?php echo e(url('supervisores/supervisados')); ?>" >
              <i class="fa fa-bullseye"></i>
              <label for="Tareas" class="hidden-xs">Supervisiones</label>
            </a>
          </li>
          <?php endif; ?>

           <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          <a href="<?php echo e(url('tareas/tareaProgramadas')); ?>" >
              <i class="fa  fa-calendar-check-o "></i>
              <label for="Tareas" class="hidden-xs">Tareas</label>
            </a>
          </li>
         <!-- Messages: style can be found in dropdown.less-->
         <?php /*  <li class="dropdown messages-menu">
          <a href="<?php echo e(url('tareas/tareaDiaria')); ?>">
              <i class="fa fa-coffee"></i>
              <label for="Tareas" class="hidden-xs">Tareas Diarias</label>
            </a>
          </li> */ ?>
         <!-- Messages: style can be found in dropdown.less-->
         <?php /*  <li class="dropdown messages-menu">
          <a href="<?php echo e(url('tareas/proyecto')); ?>">
              <i class="fa fa-briefcase"></i>
              <label for="Tareas" class="hidden-xs">Proyecto</label>
            </a>
          </li> */ ?>
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
            </a>
          </li>
          <li class="dropdown tasks-menu" style="background: #DD4B39;">
            <a href="<?php echo e(url('/logout')); ?>">
              <i class="fa fa-sign-out"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">