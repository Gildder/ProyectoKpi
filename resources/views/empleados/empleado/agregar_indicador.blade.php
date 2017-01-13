   <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header" style="background: #3c8dbc; margin: 0; ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 style=" margin: 0">Agregar Indicador</h3>
      </div>
      <div class="modal-body">
           {!!Form::open()!!}
            <div class="modal-body">
              
		<div class="col-lg-12">
	        <p>Seleccionar los indicadores que se aplicaran al empleado.</p>
          
          @if(count($indicadores_libres) > 0)
            <div class="col-sm-12" style="background: white; padding: 10px;">
              {!!Form::open(['route'=>['empleados.empleado.update', $empleados->id], 'method'=>'PUT'])!!}
                 <label for="cargos">Seleccionar Indicador:</label><br>
                     @foreach($indicadores_libres as $item)
                       <!--<option value="{{$item->id}}">{{$item->nombre}}</option>-->
                       <label>{{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }}</label><br>
                     @endforeach
              {!! Form::close()!!}
            </div>

          @else
            <div class='alert alert-success' role="alert">
              <button type="button" class="close" data-dismiss="alert" style="top: 0px  position: relative; float: right;">&times;</button>
              <strong>No hay Indicadores disponibles para agregar a este empleado.</strong>
            </div>

          @endif
	    </div>


            </div>
            <div class="modal-footer">
                  {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-sm' ]) !!}
                  <button type="button" style="margin: 0;" data-dismiss="modal"  class="btn btn-danger navbar-btn">Cancelar</button>
            </div>
      {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>