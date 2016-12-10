@extends('layouts.app')

@section('titulo')
      Editar Departamento
@endsection

@section('content')
      <h1 class="box-title">Editar</h1> <h3>{{$departamento->id}} - {{$departamento->nombre}}</h3>
      <hr>
	<div id="formNuevo" class="row panel panel-default " >
            @include('partials/alert/error')

            {!!Form::model($departamento, ['route'=>['localizaciones.departamento.update', $departamento->id], 'method'=>'PUT'])!!}
                  <div class="form-group col-sm-5 ">
                        <label for="nombre" class="hidden-xs">Nombre</label>
                        {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
                  </div>
                  <div class="form-group col-sm-5 ">
                        <label for="nombre" class="hidden-xs">Grupo Departamento</label>
                        <select class="form-control" name="grupodep_id">
                              @foreach($grupo as $item)
                                    @if($item->idgrupo==$departamento->grupodep_id)
                                          <option value="{{$item->idgrupo}}" selected="selected" >{{$item->nombregrupo}}</option>
                                    @else
                                          <option value="{{$item->idgrupo}}" >{{$item->nombregrupo}}</option>
                                    @endif
                              @endforeach
                        </select>
                        <script>seleccionar('$departamento->grupodep_id')</script>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12">
                        {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-xs-12 col-sm-2' ]) !!}

                        <button  id="cancelar" class="btn btn-danger col-xs-12 col-sm-2 " type="reset"><span class="glyphicon glyphicon-remove"> Cancelar</span></button>
                  </div>
            {!! Form::close()!!}
		
	</div>


<script>
      $('#nuevo').click(function(e){
            document.location.href = "{{route('localizaciones.departamento.create')}}";

      });


      $('#cancelar').click(function(e){
           document.location.href = "{{route('localizaciones.departamento.index')}}";
      });

      function seleccionar(elemento) {
         var combo = document.forms["grupodep_id"].tuSelect;
         var cantidad = combo.length;
         for (i = 0; i < cantidad; i++) {
            if (combo[i].value == elemento) {
               combo[i].selected = true;
            }   
         }
      }

</script>   

@endsection