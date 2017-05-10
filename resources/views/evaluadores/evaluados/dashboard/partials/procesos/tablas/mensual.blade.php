<table id="tablaEvaluadores" class="table table-bordered table-hover table-response">
  <thead class="headerTable">
  <tr style="font-weight: bold;" >
    <th>Nro</th>
    <th>Indicadores</th>
    <th title="Ponderacion">POND</th>
    @foreach($contadorMeses as $itemMes)
      <th>{{ $item }}</th>
    @endforeach
    <th>Promedio</th>
  </tr>
  </thead>
  <tfoot>
  <tr style="border-top: 2px solid gray;">
    <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
    <td><b>{!! $cumplimiento !!} %</b></td>
  </tr>
  </tfoot>
  <tbody>
  <?php $contador = 1; ?>
  @foreach($indicadores as $item)
    <tr>
      <td><a href="{{ route('evaluadores.evaluados.empleadosEvaluados', [$item->id, $evaluador->id ]) }}" class="btn btn-warning btn-xs"> {{ $item->id }} </a></td>
      <td class="m-{{$item->id}}">{{$item->nombre}}</td>
      <td style="font-weight: bold;"> {{$item->ponderacion}} %</td>
      @foreach($valorMeses as $itemValor)
        <td class="{{ $item->semana1 }}"> {{ $item->mes }} %</td>
      @endforeach
      <td class="{{ $item->promedio }}" style="font-weight: bold;">{{ $item->promedio }} %</td>
    </tr>

  @endforeach
  </tbody>

</table>
