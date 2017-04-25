<div class="row col-sm-12">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"  tabindex="2">
    <div class="text-right col-sm-12">
      <a  href="#" class="btn btn-warning btn-xs" title="Ver Graficos"><span class="fa fa-area-chart">  </span> </a>
      <a  href="#" class="btn btn-danger btn-xs" title="Exportar PDF"><span class="fa  fa-file-pdf-o"> Pdf </span> </a>
      <a  href="#" class="btn btn-success btn-xs" title="Exportar XLS"><span class="fa fa-file-excel-o"> Excel </span> </a>
    </div>
      
  </div>
  {{-- Opciones de Menu --}}
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="btn-group pull-right" data-toggle="buttons-checkbox">
      <label for="mes" class="pull-left" style="margin-right: 10px;">Seleccionar Mes:  </label>
      <button class="btn btn-default btn-sm left">&lsaquo;</button>
      <button class="btn btn-default btn-sm "><b>Middle</b></button>
      <button class="btn btn-default btn-sm  right">&rsaquo;</button>
    </div>
    <p>El % de Cumplimiento de los Indicadores de Procesos del Mes de <i> {!! $mes !!}</i> es <b>{!! $cumplimiento !!} %</b> </p><br>
  </div>

  <div class="row col-sm-12">
    <table id="myTable1" class="table table-bordered table-hover table-response">
      <thead>
        <tr style="font-weight: bold;" >
          <th>Nro</th>
          <th>Indicadores</th>
          <th title="Ponderacion">POND</th>
          <th>Semana 1</th>
          <th>Semana 2</th>
          <th>Semana 3</th>
          <th>Semana 4</th>

          {{-- verificamos nro de semanas --}}
          @if($semanaCant == 5)
            <th>Semana 5</th>
          @elseif($semanaCant == 6)
            <th>Semana 5</th>
            <th>Semana 6</th>
          @endif
          <th>Promedio</th>
        </tr>
      </thead>
      <tbody>
        <?php $contador = 1; ?>
        @foreach($indicadores as $item)
            <tr>
              <td><a href="#" class="btn btn-warning btn-xs"> {{ $item->id }} </a></td>
              <td class="m-{{$item->id}}">{{$item->nombre}}</td>
              <td style="font-weight: bold;"> {{$item->ponderacion}} %</td>
              <td class="{{ $item->semana1 }}"> {{ $item->semana1 }} %</td>
              <td class="{{ $item->semana2 }}">{{ $item->semana2 }} %</td>
              <td class="{{ $item->semana3 }}">{{ $item->semana3 }} %</td>
              <td class="{{ $item->semana4 }}">{{ $item->semana4 }} % </td>
              @if($semanaCant == 5)
                <td class="{{ $item->semana5 }}">{{ $item->semana5 }} %</td>
              @endif 

              @if($semanaCant == 6)
                <td class="{{ $item->semana5 }}">{{ $item->semana5 }} %</td>
                <td class="{{ $item->semana6 }}">{{ $item->semana6 }} %</td>
              @endif
              <td class="{{ $item->promedio }}" style="font-weight: bold;">{{ $item->promedio }} %</td>
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


    // recorremos las tabla de los valores
    $("#myTable1 tbody tr").each(function () 
    {

      var valor;
      $(this).children("td").each(function () 
      {
          valor = $(this).attr('class');
          
          if( valor >= 0 && valor <= 79 ){
            $(this).css("background-color", "#f3d2d2");
            $(this).css("color", "#9c0006");
          }

          if(valor >= 80 && valor <= 89 ){
            $(this).css("color", "#9c6500");
            $(this).css("background-color", "#fff2ca");
          }

          if(valor >= 90 && valor <= 100 ){
            $(this).css("color", "#006100");
            $(this).css("background-color", "#dcf2cf");
          }

          if(valor > 100 ){
            $(this).css("color", "#1f4e78");
            $(this).css("background-color", "#d1e4f5");
          }

          if(valor == -1 ){
              $(this).html("-");
          }

      })

      $(this).css("font-wei", "#f3d2d2");
    });



});

</script>