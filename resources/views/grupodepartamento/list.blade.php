@extends('layouts.app')

@section('content')
<div class="page-heafer">	
	<h1>Grupo Departamentos<small>Grupo Nuevos Departamentos</small></h1>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				Lista
				<p class="navbar-text navbar-right" style="margin-top: 1px">
					<button type="button" class="btn btn-warning navbar-btn" style="margin-bottom: 1px; margin-top: -5px; margin-right: 5px; padding: 3px 20px;">Nuevo</button>
				</p>
			</div>

			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Acciones</th>
					</thead>

					<tbody>
						@foreach($grdepartamentos as grupo)
							<tr>
								<td>{{$grupo->id}}</td>
								<td>{{$grupo->nombre}}</td>
								<td>{{$grupo->estado}}</td>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection