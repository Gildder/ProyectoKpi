<!-- Nuevo -->
<div class="panel panel-default">
      {!!Form::open(['route'=>'empleados.cargo.store', 'method'=>'POST'])!!}
  <div class="panel-heading">
      <a  href="{{route('empleados.cargo.index')}}" class="btn btn-default"><span class="fa fa-reply"></span></a>
      <h3 class="box-title">Nuevo Cargo</h3>
  </div>
  <div class="panel-body">
      
      @include('partials/alert/error')

      <div class="form-group col-sm-3">
          <label for="nombre" class="hidden-xs">Nombre</label>
          {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
      </div>
            
  </div>
  <div class="panel-footer">
      <a  id="cancelar" href="{{route('empleados.cargo.index')}}" class="btn btn-danger" type="reset">Cancelar</a>
      {!! form::submit('Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'<span class="glyphicon glyphicon-ok">Guardar</span>', 'class'=>'btn btn-success' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->