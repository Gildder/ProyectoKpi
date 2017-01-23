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
        <td><a data-toggle="modal" data-target="#modal-show-{{$indicador->id}}" class="btn btn-warning btn-xs"><span >{{$indicador->id}}</span></a></td>
        <td>{{$indicador->nombre}}</td>
        <td>{{$indicador->tipo}}</td>
        <td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
        <td>{{$indicador->condicion}}</td>
        <td>{{$indicador->frecuencia}}</td>
        <td>
          <a href="" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-supr-{{$indicador->id}}"><span class="fa fa-times"></span> <b>Quitar</b> </a>
        </td>
      </tr>
      @include('empleados/cargo/partials/ver_indicador')
      @include('empleados/cargo/partials/delete_indicador')
    @endforeach
    </tbody>
  </table>

</div>