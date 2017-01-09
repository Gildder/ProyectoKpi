<div class="table-response">
  <table id="myTable1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Codigo</th>
      <th>Nombre Completo</th>  
      <th>Usuario</th>  
      <th>Correo</th> 
      <th>Cargo</th>  
      <th>Localizaciones</th> 
      <th>Departamentos</th>  
    </thead>
    <tbody>
    @foreach($empleados as $empleado)
      <tr>
        <td>{{$empleado->id}}</td>
        <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
        <td>{{$empleado->usuario}}</td>
        <td>{{$empleado->correo}}</td>
        <td>{{$empleado->cargo}}</td>
        <td>{{$empleado->localizacion}}</td>
        <td>{{$empleado->departamento}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>