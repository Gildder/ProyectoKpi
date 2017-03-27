
<table id="myTable1" class="table table-bordered table-hover table-response">
  <thead>
    <tr>
      <th>Nro</th>
      <th>Indicadores</th>
      <th title="Ponderacion">POND</th>
    </tr>
  </thead>
  <tbody>
    <?php $contador = 0; ?>
    @foreach($indicadores as $item)
        <tr>
          <td>{{$contador++ }}</td>
          <td class="m-{{$item->id}}">{{$item->nombre}}</td>
          <td >Semana {{$item->ponderacion}}</td>
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