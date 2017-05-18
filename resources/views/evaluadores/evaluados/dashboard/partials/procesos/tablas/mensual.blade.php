<table id="tablaEvaluadores" class="table table-bordered table-hover table-response">
  <thead class="headerTable">
  <tr style="font-weight: bold;" >
    <th>Nro</th>
    <th>Indicadores</th>
    <th title="Ponderacion">POND</th>
    <?php for($contador = \FiltroTabla::getPrimerMes(); $contador<= \FiltroTabla::getUltimoMes(); $contador++ ){ ?>
      <th>{{ \Calcana::getNombreMes($contador) }}</th>
    <?php } ?>
    <th>Promedio</th>
  </tr>
  </thead>
  <tfoot>
  <tr style="border-top: 2px solid gray;">
    <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
    <td><b>{!! \Cache::get('cumplimientoMes') !!} %</b></td>
  </tr>
  </tfoot>
  <tbody>
  @foreach(\Cache::get('tablaMes') as $item)
    <tr>
      <td><a href="{{ route('evaluadores.evaluados.empleadosEvaluados', [$item->getId(), \Cache::get('evadores')->id ]) }}" class="btn btn-warning btn-xs"> {{ $item->getId() }} </a></td>
      <td class="m-{{$item->getId()}}">{{ $item->getNombre() }}</td>
      <td style="font-weight: bold;"> {{ $item->getPonderacion() }} %</td>
      <?php for($contador = \FiltroTabla::getPrimerMes(); $contador<= \FiltroTabla::getUltimoMes(); $contador++ ){ ?>
          <td> {{ $item->getMes($contador) }} %</td>
      <?php } ?>
      <td class="{{ $item->getPromedio() }}" style="font-weight: bold;">{{ $item->getPromedio() }} %</td>
    </tr>

  @endforeach
  </tbody>

</table>
