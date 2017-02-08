<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        {{-- <h3 class="box-title">{{$primer->mes}} - {{$primer->gestion}}</h3> --}}
      </div>
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover table-response">
          <thead>
            <tr>
              <th>Nro</th>
              <th>Meses</th>
              <th>Semanas</th>
              <th>Actividades Programadas</th>
              <th>Actividades Realizadas</th>
              <th>Eficiencia Actividad</th>
            </tr>
          </thead>
          <tbody>
            <?php $contador = 1; ?>
            @foreach($grafico as $indicador)
              <tr>
                <td>{{$contador++}}</td>
                <td class="m-{{$indicador->mes}}"></td>
                <td>Semana {{$indicador->semana}}</td>
                <td>{{$indicador->actpro}}</td>
                <td>{{$indicador->actrea}}</td>
                <td><span class="{{$indicador->semana}}"> {{$indicador->efeser}}%</span></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>


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