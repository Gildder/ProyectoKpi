@extends('layouts.app')

@section('content')
      <h3 class="box-title">Nuevo Departamento</h3>
      <hr>

      @include('partials/alert/error')

<div id="formNuevo" class="row panel panel-default" >
      {!!Form::open(['route'=>'localizaciones.departamento.store', 'method'=>'POST'])!!}
            <div class="form-group col-sm-5 ">
                  <label for="nombre" class="hidden-xs">Nombre</label>
                  {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
            </div>
            <div class="form-group col-sm-5 ">
            	<label for="nombre" class="hidden-xs">Grupo Departamento</label>
                  {!! form::select('nombre',$grupo,null, ['id'=>'grupodep_id', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']) !!}
            </div>
            <div class="form-group col-lg-12 col-sm-12">
                  {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-xs-12 col-sm-2' ]) !!}

            	<button  id="cancelar" class="btn btn-danger col-xs-12 col-sm-2 " type="reset"><span class="glyphicon glyphicon-remove"> Cancelar</span></button>
            </div>
      {!! Form::close()!!}

</div>

<script>

      $('#cancelar').click(function(e){
           document.location.href = "{{route('localizaciones.departamento.index')}}";
      });

      $('#guardar').click(function(e){
            document.getElementById('#alertError').style.display == 'none';
            document.location.href =  "{{route('localizaciones.departamento.store')}}";
      });

</script>      

@endsection