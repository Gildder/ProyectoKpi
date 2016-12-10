@extends('layouts.app')

@section('titulo')
      Editar Departamento
@endsection

@section('content')
      <h1 class="box-title">Asignación de cargos</h1>
      <a href="{{route('indicadores.indicador.index')}}" class="btn btn-primary  pull-right">Volver</a>
      <hr>
   <div id="formNuevo" class="row panel panel-default" >
   @include('partials/alert/error')
                 
   <!--tabla de cargos-->
   <div class="row">
      <div class="col-lg-12">
         <h3>Lista de Puestos</h3>
         <p>Los puestos de trabajo a los cuales se aplicara el indicador.</p>

            @if(count($cargos_libres) > 0)
         <div class="col-sm-12" style="background: white; padding: 10px;">

         
            {!!Form::open(['route'=>['indicadores.indicador.update', $indicador->id], 'method'=>'PUT'])!!}
               <label for="cargos">Seleccionar Puestos:</label><br>
                   @foreach($cargos_libres as $item)
                     <!--<option value="{{$item->id}}">{{$item->nombre}}</option>-->
                     <label>{{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }}</label><br>
                   @endforeach
               <div class="col-sm-12">
                   {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-sm' ]) !!}
               </div>
            {!! Form::close()!!}
         </div>

            @else
              <div class='alert alert-success' role="alert">
                <button type="button" class="close" data-dismiss="alert" style="top: 0px  position: relative; color: white;">&times;</button>
                <strong>No hay Puestos disponibles para agregar a este indicador</strong>
              </div>

            @endif

         <div class="table-response">
            <table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
               <thead>
                  <th>Nro</th>
                  <th>Nombre</th>   
                  <th  class="hidden-xs">Estado</th>   
                  <th  class="hidden-xs">Fecha Modificacion</th>   
                  <th >Opciones</th>
               </thead>

               <tbody>
               @foreach($cargos_indicardor as $cargo)
                  <tr>
                     <td>{{$cargo->id}}</td>
                     <td>{{$cargo->nombre}}</td>
                     <td  class="hidden-xs">@if($cargo->estado == '1') <span class="btn-success  btn-xs">Habilitado</span> @else <span class="btn-danger btn-xs">Desabilitado</span> @endif </td>
                     <td  class="hidden-xs">{{$cargo->updated_at}}</td>
                     <td>
                        <a href="{{route('indicadores.indicador.quitar', [$indicador->id, $cargo->id])}}" class="btn btn-primary btn-sm"><span class=""  title="Baja"></span><span >Quitar</span></a>
                     </td>
                  </tr>
               @endforeach
               </tbody>
         
            </table>
         </div>
      </div>
   </div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
   $(document).ready(function(){
       $('#myTable').DataTable();
      //$("#formNuevo").css("display", "none");
      //$(".alert").css("display", "none");

   });

   var ObtenerCargos = function(id)
   {
      alert(id);
      var route = "{{url('indicadores.indicador.asign')}}/"+id;
     
      $.ajax(route, function(data){
         alert(data);
      });
   }


</script>  

@endsection