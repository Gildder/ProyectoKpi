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
              {{-- <th>Gestion</th> --}}
              <th>Meses</th>
              <th>Semanas</th>
              <th>Total Operaciones</th>
              <th>No. Errores</th>
              <th>Eficiencia Actividad</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $contador = 1; ?>
            @foreach($listaTablas as $indicador)
              <tr>
                <td data-id="{{$indicador->id}}">{{$contador++}}</td>
                {{-- <td>{{$indicador->gestion}}</td> --}}
                <td class="m-{{$indicador->mes}}"></td>
                <td >Semana {{$indicador->semana}}</td>
                <td>{{$indicador->totope}}</td>
                <td>{{$indicador->numerr}}</td>
                <td><span class="{{$indicador->semana}}"> {{$indicador->efeact}}%</span></td>
                <td>
                  <a href="{{route('supervisores.supervisados.obtenerTareasFinalizadas', [$indicador->gestion, $indicador->mes, $indicador->semana, $empleado->codigo ] )}}" class="btn btn-danger btn-xs" @if($indicador->totope <= 0)  disabled @elseif($indicador->totope = $indicador->numerr) disabled  @endif  ><i class="fa fa-thumbs-up " title="Agregar Error"></i></a>
                  <a href="{{route('supervisores.supervisados.obtenerTareasErrores', [$indicador->gestion, $indicador->mes, $indicador->semana, $empleado->codigo ] )}}" class="btn btn-success btn-xs" @if($indicador->numerr <= 0)  disabled  @endif><i class="fa fa-thumbs-down" title="Quitar Error"></i></a>
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


