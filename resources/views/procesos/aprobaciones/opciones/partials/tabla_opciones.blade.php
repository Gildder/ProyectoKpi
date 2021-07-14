<div class="table-responsive">
	<table id="tablaOpcionAprobacion" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Aprobaciones</th>
			<th>Aprobador</th>
			<th></th>
		</thead>

		{{--<tbody>--}}
		{{--@foreach($opciones as $opcion)--}}
			{{--<tr>--}}
				{{--<td>--}}
					{{--{{$opcion->descripcion}}--}}
				{{--</td>--}}
				{{--<td>--}}
					{{--{!! $opcion->user->nombres !!} {!! $opcion->user->apellidos !!}--}}
				{{--</td>--}}
			{{--</tr>--}}
		{{--@endforeach--}}
		{{--</tbody>--}}

	</table>
</div>

<script>

    $(document).ready(function () {
        let _id = $('#evalaudor_aprovador').val();
        let urlString = '/procesos/aprobaciones/opcionesAprobacion';
        console.log(urlString);
        table = $('#tablaOpcionAprobacion').DataTable({
            dom: 'Blfrtip',
            // guarmos los filtro de la tabla
            stateSave: true,
            destroy: true,
            searching: true,

            ajax:  {
                url: urlString,
                data: { evaluador_id: _id},
                type: 'GET',
                dataSrc: ''
            },

            columns: [
                { data: 'opcion' },
                {
                    sortable: false,
                    render: function ( data, type, full, meta ) {
                        return '('+ full.nombre +' '+ full.apellido + ')';
                    }
                },
                {
                    sortable: false,
                    render: function ( data, type, full, meta ) {
                        var numero = full.numero;
                        var id = full.id;
                        return '<a href="#" data-num="'+full.id+'" class="btn btn-warning btn-xs" @click="editarUsuarioAprobacion($event)" title="Editar"><span class="fa fa-edit" ></span></a><a href="#" data-num="'+full.id+'" class="btn btn-danger btn-xs" @click="eliminarUsuarioAprobacion($event)" title="Elimnar"><span class="fa fa-trash" ></span></a>';
                    }
                },

            ]
        });
    })
</script>
