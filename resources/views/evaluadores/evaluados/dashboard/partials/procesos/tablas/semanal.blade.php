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
      @if($semanaCant == 5)
        <th>Semana 5</th>
      @elseif($semanaCant == 6)
        <th>Semana 5</th>
        <th>Semana 6</th>
      @endif
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
