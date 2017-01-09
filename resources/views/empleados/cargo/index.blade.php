@extends('layouts.app')

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
  	<h3 class="box-title">Cargos</h3>
  </div>
  <div class="panel-body">
  	
	@include('partials/alert/error')

  <div class="row">
		<div class="col-lg-12">
			@include('empleados/cargo/tabla_cargo')
		</div>
	</div>

  </div>
  <div class="panel-footer">
	<div class="text-right">
		<a  id="nuevo" href="{{route('empleados.cargo.create')}}"   class="btn btn-success" >Nuevo</a>
    </div>
  </div>
</div>

@endsection