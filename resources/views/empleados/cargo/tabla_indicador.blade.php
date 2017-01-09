<div class="table-response">
  <table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Nro</th>
      <th>Nombre</th> 
      <th>Tipo</th> 
      <th>Objetivo</th> 
      <th>Condicion</th>  
      <th>Frecuencia</th> 
      <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($indicadores as $indicador)
      <tr>
        <td><a class="btn btn-primary btn-xs" class="btn btn-primary btn-xs" ><span >{{$indicador->id}}</span></a></td>
        <td>{{$indicador->nombre}}</td>
        <td>{{$indicador->tipo_indicador_id}}</td>
        <td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
        <td>{{$indicador->condicion}}</td>
        <td>{{$indicador->frecuencia}}</td>
        <td>
          <a href="" class="btn btn-danger btn-small"  data-toggle="modal" data-target="#myModalIndicador">Quitar</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  @include('empleados/cargo/delete_indicador')
</div>