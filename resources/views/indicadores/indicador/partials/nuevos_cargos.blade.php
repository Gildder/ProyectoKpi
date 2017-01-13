<div class="col-sm-12" style="background: white; padding: 10px;">
{!!Form::open(['route'=>['indicadores.indicador.update', $indicador->id], 'method'=>'PUT'])!!}
   <label for="cargos">Seleccionar Puestos:</label><br>
       @foreach($cargos_libres as $item)
         <!--<option value="{{$item->id}}">{{$item->nombre}}</option>-->
         <label>{{ Form::checkbox('prov[]', $item->id) }} {{ $item->nombre }}</label><br>
       @endforeach
   <div class="col-sm-12">
       {!!form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success col-sm']) !!}
   </div>
{!! Form::close()!!}
</div>