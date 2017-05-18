<div id="filtroSemana" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="btn-group pull-right" data-toggle="buttons-checkbox">
    <label for="mes" class="pull-left" style="margin-right: 10px;">Seleccionar Mes:  </label>
    <a class="btn btn-default btn-sm left" name='anterior' id="btnAnterior" @if(\FiltroTabla::getMesBuscado() == 1) disabled @endif href="{{ route('evaluadores.evaluados.dashboard') }}" title="Anterior">&lsaquo;</a>
    <a class="btn btn-default btn-sm "><b>{{ \Calcana::getNombreMes(\FiltroTabla::getMesBuscado())  }}</b></a>
    <a class="btn btn-default btn-sm  right" name='siguiente' id="btnSiguiente" @if(\FiltroTabla::getMesBuscado() == \FiltroTabla::getUltimoMes())) disabled @endif href="{{ route('evaluadores.evaluados.dashboard') }}" title="Siguiente">&rsaquo;</a>
  </div>
  <h3>{{ \Calcana::getNombreMes(\FiltroTabla::getMesBuscado()) }} </h3>
  <p>El % de Cumplimiento de los Indicadores de Procesos del Mes de <i> {{ \Calcana::getNombreMes(\FiltroTabla::getMesBuscado()) }}</i> es <b>{!! \Cache::get('cumplimientoSemana') !!} %</b></p><br>
</div>

<table id="tablaEvaluadores" class="table table-bordered table-hover table-response">
  <thead class="headerTable">
    <tr style="font-weight: bold;" >
      <th>Nro</th>
      <th>Indicadores</th>
      <th title="Ponderacion">POND</th>
      <th>Semana 1</th>
      <th>Semana 2</th>
      <th>Semana 3</th>
      <th>Semana 4</th>
      {{-- verificamos nro de semanas --}}
      @if(\Cache::get('cantSemana') == 5)
        <th>Semana 5</th>
      @elseif(\Cache::get('cantSemana') == 6)
        <th>Semana 5</th>
        <th>Semana 6</th>
      @endif
      <th>Promedio</th>
    </tr>
  </thead>
  <tfoot>
    <tr style="border-top: 2px solid gray;">
      <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
      <td><b>{!! \Cache::get('cumplimientoSemana') !!} %</b></td>
    </tr>
  </tfoot>
  <tbody>
    <?php $contador = 1; ?>
    @foreach(\Cache::get('tablaSemana') as $item)
        <tr>
          <td><a href="{{ route('evaluadores.evaluados.empleadosEvaluados', [$item->getId(), \Cache::get('evadores')->id ]) }}" class="btn btn-warning btn-xs"> {{ $item->getId() }} </a></td>
          <td class="m-{{$item->getId() }}">{{$item->getNombre()}}</td>
          <td style="font-weight: bold;"> {{$item->getPonderacion() }} %</td>
          <td class="{{ $item->getSemana1() }}"> {{ $item->getSemana1() }} %</td>
          <td class="{{ $item->getSemana2() }}">{{ $item->getSemana2() }} %</td>
          <td class="{{ $item->getSemana3() }}">{{ $item->getSemana3() }} %</td>
          <td class="{{ $item->getSemana4() }}">{{ $item->getSemana4() }} % </td>
          @if(\Cache::get('cantSemana') == 5)
            <td class="{{ $item->getSemana5() }}">{{ $item->getSemana5() }} %</td>
          @endif 

          @if(\Cache::get('cantSemana') == 6)
            <td class="{{ $item->getSemana6() }}">{{ $item->getSemana6() }} %</td>
            <td class="{{ $item->getSemana7() }}">{{ $item->getSemana7() }} %</td>
          @endif
          <td class="{{ $item->getPromedio() }}" style="font-weight: bold;">{{ $item->getPromedio() }} %</td>
        </tr>

    @endforeach
  </tbody>

</table>
