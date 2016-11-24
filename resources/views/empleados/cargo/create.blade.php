@extends('layouts.app')

@section('content')
      <h3 class="box-title">Nuevo Cargo</h3>
      <hr>

      @include('partials/alert/error')

<div id="formNuevo" class="row panel panel-default" >
      {!!Form::open(['route'=>'empleados.cargo.store', 'method'=>'POST'])!!}
            <div class="form-group col-sm-5 ">
            	<label for="nombre" class="hidden-xs">Nombre</label>
                  {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
            </div>
            <div class="form-group col-lg-12 col-sm-12">
                  {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-xs-12 col-sm-2' ]) !!}

            	<button  id="cancelar" class="btn btn-danger col-xs-12 col-sm-2 " type="reset"><span class="glyphicon glyphicon-remove"> Cancelar</span></button>

            <!--
                  <button  id="guardar" class="btn btn-success col-xs-12 col-sm-2" type="submit"><span class="glyphicon glyphicon-ok"> Guardar</span></button>

            -->
            </div>
      {!! Form::close()!!}

</div>

<script>

      $('#cancelar').click(function(e){
           document.location.href = "{{route('empleados.cargo.index')}}";
      });

      $('#guardar').click(function(e){
             document.location.href =  "{{route('empleados.cargo.store')}}";
      });

</script>      

@endsection