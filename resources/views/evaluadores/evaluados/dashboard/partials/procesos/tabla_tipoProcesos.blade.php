<div class="row col-sm-12">

    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <a  href="{{route('evaluadores.escala.create')}}" class="btn btn-primary btn-xs pull-right" title="Ver Filtros"><span class="fa fa-filter">  </span> </a>
    </div>

  <div class="row col-sm-12">
    <table id="myTable1" class="table table-bordered table-hover table-response">
      <thead>
        <tr>
          <th>Nro</th>
          <th>Indicadores</th>
          <th title="Ponderacion">POND</th>
        </tr>
      </thead>
      <tbody>
        <?php $contador = 1; ?>
        @foreach($indicadores as $item)
            <tr>
              <td><a href="#" class="btn btn-warning btn-xs"> {{ $item->id }} </a></td>
              <td class="m-{{$item->id}}">{{$item->nombre}}</td>
              <td > {{$item->ponderacion}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function(){
    $(".1").addClass("badge bg-light-blue");
    $(".2").addClass("badge bg-red");
    $(".3").addClass("badge bg-yellow");
    $(".4").addClass("badge bg-green");

    // Meses
    // $(".m-1").html("Enero");
    // $(".m-2").html("Febrero");
    // $(".m-3").html("Marzo");
    // $(".m-4").html("Abril");
    // $(".m-5").html("Mayo");
    // $(".m-6").html("Junio");
    // $(".m-7").html("Julio");
    // $(".m-8").html("Agosto");
    // $(".m-9").html("Septiembre");
    // $(".m-10").html("Octubre");
    // $(".m-11").html("Noviembre");
    // $(".m-12").html("Diciembre");
});

</script>