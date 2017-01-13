<div class="col-lg-12">
	 <p>Lista de todos los cargos aplicados a este indicador</p>

	@if(count($cargos_libres) > 0)

	@else
	  <div class='alert alert-success' role="alert">
	    <button type="button" class="close" data-dismiss="alert" style="top: 0px  position: relative; float: right;">&times;</button>
	    <strong>No hay Puestos disponibles para agregar a este indicador</strong>
	  </div>

	@endif

		@include('partials/alert/error')


	 <div class="table-response">
	    <table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
	       <thead>
	          <th>Nro</th>
	          <th>Nombre</th>   
	          <th  class="hidden-xs">Estado</th>   
	          <th >Opciones</th>
	       </thead>

	       <tbody>
	       @foreach($cargos_indicardor as $cargo)
	          <tr>
	             <td>{{$cargo->id}}</td>
	             <td>{{$cargo->nombre}}</td>
	             <td  class="hidden-xs">@if($cargo->estado == '1') <span class="btn-success  btn-xs">Habilitado</span> @else <span class="btn-danger btn-xs">Desabilitado</span> @endif </td>
	             <td>
	                <a  data-toggle="modal" data-target="#modal-delete-{{$cargo->id}}" class="btn btn-primary btn-sm"><span class=""  title="Quitar"></span><span >Quitar</span></a>
	             </td>
	          </tr>
			@include("indicadores/indicador/quitar")
	       @endforeach
	       </tbody>
	 
	    </table>
	 </div>
</div>


@section('script')


$(document).on("click","#guardar",function(e){
	
	$( "#cargo" ).addClass( "active" );
	$( "#datos" ).removeClass( "active" );
});


@endsection