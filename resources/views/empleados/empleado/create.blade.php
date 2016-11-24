
		<div class="panel panel-default">
		{!!Form::open(['route'->'localizaciones.grupodepartamento.store', 'method'->'POST'])!!}
			<!--<form action="">-->
				<div class="form-group">
					{!! form::label('Nombre') !!}
					{!! form::text('name',null, ['id'->'nombre', 'class'->'form-control', 'placeholder'->'Ingrese su Nombre']) !!}
				</div>

				<div class="form-group">
					{!! form::submit('Guardar',['name'->'guardar', 'id'->'guardar', 'content'->'<span>Guardar</span>', 'class'->'btn btn-success']) !!}
					{!! form::submit('Cancelar',['name'->'cancelar', 'id'->'cancelar', 'content'->'<span>Cancelar</span>', 'class'->'btn btn-danger']) !!}
				</div>
				<!--
				<button class="btn btn-success">Guardar</button>
				<button class="btn btn-danger">Cancelar</button>

				-->
			<!--</form>-->

		{!! Form::close()!!}
		</div>
		<!--
		<div id="formNuevo" class="panel panel-default" style="background: #D9D8DE; padding: 20px; display: none;">
			{!!Form::open(['route'->'localizaciones.grupodepartamento.store', 'method'->'POST'])!!}
				<div class="form-group">
					{!! form::label('Nombre') !!}
					{!! form::text('name',null, ['id'->'nombre', 'class'->'form-control', 'placeholder'->'Ingrese su Nombre']) !!}
				</div>

				<div class="form-group">
					{!! form::submit('Guardar',['name'->'guardar', 'id'->'guardar', 'content'->'<span>Guardar</span>', 'class'->'btn btn-success']) !!}
					<button onclick="ocultarFormRegistro()" class="btn btn-danger">Cancelar</button>
				</div>
			{!! Form::close()!!}
		</div>
-->