<!-- Editar -->

<div class="panel panel-default">
      {!!Form::model($cargo, ['route'=>['empleados.cargo.update', $cargo->id], 'method'=>'PUT'])!!}
  <div class="panel-heading">
      <a  href="{{route('empleados.cargo.index')}}" class="btn btn-default"><span class="fa fa-reply"></span></a>
      <h3 class="box-title">Cargo - {{$cargo->nombre}}</h3>
  </div>
  <div class="panel-body">
      
      @include('partials/alert/error')

      <div class="form-group col-sm-3">
          <label for="nombre" class="hidden-xs">Nombre</label>
          {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
      </div>
            
  </div>
  <div class="panel-footer">
    <div class="text-right">
      <a  id="borrar" class="btn btn-danger btn-small pull-left" data-toggle="modal" data-target="#myModal">Borrar</a>
      <a  id="cancelar" href="{{route('empleados.cargo.index')}}" class="btn btn-warning text-right" type="reset">Cancelar</a>
      {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success text-right' ]) !!}
    </div>
  </div>
      {!! Form::close()!!}

  @include('empleados/cargo/delete')
    
</div>

<!-- Fin Editar --> 