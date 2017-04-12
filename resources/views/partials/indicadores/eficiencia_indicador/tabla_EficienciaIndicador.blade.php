<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
      </div>
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover table-response">
          <thead>
            <tr>
              <th>Nro</th>
              <th>Gestion</th>
              <th>Meses</th>
              <th>Semanas</th>
              <th>Total Operaciones</th>
              <th>Número de Errores</th>
              <th>Eficiencia Actividad</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $contador = 1; ?>
            @foreach($listaTablas as $indicador)
              <tr>
                <td>{{$contador++}}</td>
                <td>{{$indicador->gestion}}</td>
                <td class="m-{{$indicador->mes}}"></td>
                <td >Semana {{$indicador->semana}}</td>
                <td>{{$indicador->totope}}</td>
                <td>{{$indicador->numerr}}</td>
                <td><span class="{{$indicador->semana}}"> {{$indicador->efeact}}%</span></td>
                <td>
                  <a href="{{route('supervisores.supervisados.obtenerTareasFinalizadas', [$indicador->gestion, $indicador->mes, $indicador->semana, $empleado->codigo ] )}}" class="btn btn-danger btn-xs" @if($indicador->totope <= 0)  disabled  @endif  ><i class="fa fa-thumbs-down" title="Agregar Error"></i></a>
                  <a href="#" class="btn btn-success btn-xs" @if($indicador->numerr <= 0)  disabled  @endif><i class="fa fa-thumbs-up" title="Quitar Error"></i></a>
                </td>
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