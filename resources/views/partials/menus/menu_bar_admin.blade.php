 <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>PI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>KPI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu" title="Evaluadores">
            <a href="{{url('evaluadores/evaluador')}}" >
              <i class="fa fa-balance-scale"></i>
              <label for="Cargos" class="hidden-xs">Gerencia</label>
            </a>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu" title="Supervisores">
            <a href="{{url('supervisores/supervisor')}}" >
              <i class="fa fa-user-secret"></i>
              <label for="Indicadores" class="hidden-xs">Supervisores</label>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <span class="hidden-xs">{{ Auth::user()->name  }}</span>
            </a>
          </li>
          <li class="dropdown tasks-menu" style="background: #DD4B39;">
            <a href="{{ url('/logout') }}">
              <i class="fa fa-sign-out"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="height: auto;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="{{url('administrador')}}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
             <span class="pull-right-container">
            </span>
          </a>
        </li> 
         <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Empleados</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Opciones</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Permisos</a></li>
            <li><a @click.prevent="importarLdap" ><i class="fa fa-circle-o"></i> Importar AD</a></li>
            {{--<li><a href="{{url('administrador/importarldap')}}" ><i class="fa fa-circle-o"></i> Importar AD</a></li>--}}
            <li><a href="{{url('empleados/empleado')}}"><i class="fa fa-circle-o"></i>Empleado</a></li>
            <li><a href="{{url('empleados/cargo')}}"><i class="fa fa-circle-o"></i>Cargo</a></li>
          </ul>
        </li> 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building"></i>
            <span>Ubicaciones</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{url('localizaciones/grupolocalizacion')}}"><i class="fa fa-circle-o"></i>Grupo Localizacion</a></li>
            <li><a href="{{url('localizaciones/localizacion')}}"><i class="fa fa-circle-o"></i>Localizacion</a></li>
            <li><a href="{{url('localizaciones/grupodepartamento')}}"><i class="fa fa-circle-o"></i>Grupo Departamento</a></li>
            <li><a href="{{url('localizaciones/departamento')}}"><i class="fa fa-circle-o"></i> Departamento</a></li>
          </ul>
        </li>

        {{-- Indicadores --}}
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building"></i>
            <span>Indicadores</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('indicadores/indicador')}}"><i class="fa fa-circle-o"></i>Indicador</a></li>
          <li><a href="{{url('evaluadores/ponderacion')}}"><i class="fa fa-circle-o"></i>Ponderacion</a></li>
            <li><a href="{{url('evaluadores/escala')}}"><i class="fa fa-circle-o"></i>Escalas</a></li>
            <li><a href="{{url('estados/tareas')}}">
                <i class="fa fa-circle-o"></i>Estados</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Configuracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('indicadores/indicador')}}"><i class="fa fa-circle-o"></i>Importar Tickets</a></li>
            <li><a href="{{url('indicadores/indicadorcargos')}}"><i class="fa fa-circle-o"></i> config 1 Cargos</a></li>
            <li><a href="{{url('indicadores/indicador')}}"><i class="fa fa-circle-o"></i> Config 2</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >

