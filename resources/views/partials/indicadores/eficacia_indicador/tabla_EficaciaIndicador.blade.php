
<div class="table-responsive row col-sm-12 ">
<table id="myTable1" class="table table-bordered table-hover table-response">
  <thead>
    <tr>
      {{--<th>Nro</th>--}}
      <th>Mes</th>
      <th>Semana</th>
      <th>Actividades Programadas</th>
      <th>Actividades Realizadas</th>
      <th>Eficacia Actividad</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listaTablas as $item)
        <tr>
{{--          <td>{{$contador++ }}</td>--}}
          <td class="m-{{$item->mes}}">{{ \Calcana::getNombreMes($item->mes) }}</td>
          <td >Semana {{$item->semana}}</td>
          <td>{{$item->actpro}}</td>
          <td>{{$item->actrea}}</td>
          <td><span class="{{$item->semana}}"> {{$item->efeser}}%</span></td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>


