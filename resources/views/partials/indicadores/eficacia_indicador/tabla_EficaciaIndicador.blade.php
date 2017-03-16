{{-- <div class="box-header with-border">
  
  <p class="text-center"><strong>Descripcion de TAbla</strong></p>
  <div class="box-tools pull-right">
    <button class="btn btn-info btn-xs" type="button" title="Ver Filtro"><i class="fa fa-filter"></i></button>
  </div>
</div> --}}


<table id="myTable1" class="table table-bordered table-hover table-response">
  <thead>
    <tr>
      <th>Nro</th>
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
          <td>{{$contador++ }}</td>
          <td class="m-{{$item->mes}}"></td>
          <td >Semana {{$item->semana}}</td>
          <td>{{$item->actpro}}</td>
          <td>{{$item->actrea}}</td>
          <td><span class="{{$item->semana}}"> {{$item->efeser}}%</span></td>
        </tr>
    @endforeach
  </tbody>
</table>


<script>
$(document).ready(function(){
    $(".1").addClass("badge bg-light-blue");
    $(".2").addClass("badge bg-red");
    $(".3").addClass("badge bg-yellow");
    $(".4").addClass("badge bg-green");

    // Meses
    $(".m-1").html("Enero");
    $(".m-2").html("Febrero");
    $(".m-3").html("Marzo");
    $(".m-4").html("Abril");
    $(".m-5").html("Mayo");
    $(".m-6").html("Junio");
    $(".m-7").html("Julio");
    $(".m-8").html("Agosto");
    $(".m-9").html("Septiembre");
    $(".m-10").html("Octubre");
    $(".m-11").html("Noviembre");
    $(".m-12").html("Diciembre");
});

</script>