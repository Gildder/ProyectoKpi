@extends('layouts.app')

@section('content')
	{!!Form::open(['route'=>'grupodepartamento.store', 'method'=>'POST'])!!}
		<div class="form-group">
			
		{!!Form::label('Nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Nombre grupo'])!!}
		</div>
		{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		{!!Form::submit('Cancelar',['class'=>'btn btn-danger'])!!}
		
	{!!Form::close()!!}

<!--
<div class="page-heafer">	
	<h1>Nuevo Grupo Departamentos</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<form action="">
				<div class="form-group">
					<label for="nombre">Nombre:</label>
					<input type="text" class="form-control">
				</div>
				<button class="btn btn-success">Guardar</button>
				<button class="btn btn-danger">Cancelar</button>
			</form>
		</div>
	</div>
</div>
-->
@endsection