<!-- Lista de Cargos-->
	<div class="col-sm-6">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	<a href="{{route('empleados.empleado.index')}}" class="btn btn-primary"><span class="fa fa-reply"></span></a>
		  	<!--<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-right"><span class="#">Agregar</span></a>-->
		  </div>
		  <div class="panel-body">

	 			@include("empleados/empleado/agregar_indicador")
				
				<div class="col-lg-12">
		         <h3>Lista de Indicadores</h3>

				@include('indicadores/indicador/tabla_indicador')
		         
		      </div>
		  </div>
		</div>
	</div>