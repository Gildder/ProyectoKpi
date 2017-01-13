   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-agregar">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Agregar Nuevos Cargos
      </div>
      <div class="modal-body modal-delete-body">
          <div class="col-sm-12" style="background: white; padding: 10px;">
			{!!Form::open(['route'=>['indicadores.indicador.update', $indicador->id], 'method'=>'PUT'])!!}
			   <label for="cargos">Seleccionar nuevos cargos:</label><br>
			   		<div class="col-sm-12">
				       @foreach($cargos_libres as $item)
				         <!--<option value="{{$item->id}}">{{$item->nombre}}</option>-->
				         <label>{{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }}</label><br>
				       @endforeach
			   		</div>
			</div>
			<div class="modal-footer modal-delete-footer">
                  <a data-dismiss="modal" class="btn btn-danger btn-sm">Cancelar</a>
			       {!!form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success btn-sm']) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
