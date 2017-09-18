<!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog"  id="modal-tareaDetalle-{{$tarea->tarea_id }}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Detalles de Tareas</b>
      </div>
      <div class="modal-body modal-delete-body">
        <div class="modal-body">
            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">No. Tarea:</b>
                @if(! is_null($tarea->nro)) {{ $tarea->nro }}@else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Descripcion:</b>
                @if(! is_null($tarea->descripcion)) {{ $tarea->descripcion  }}@else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Inicio Estimado:</b>
                @if(! is_null( $tarea->fechaInicioEstimado )) {{ $tarea->fechaInicioEstimado  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Fin Estimado:</b>
                @if(! is_null( $tarea->fechaFinEstimado )) {{ $tarea->fechaFinEstimado  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Tiempo Estimado:</b>
                @if(! is_null( $tarea->tiempoEstimado )) {{  $tarea->tiempoEstimado  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Inicio Solucion:</b>
                @if(! is_null( $tarea->fechaInicioSolucion )) {{ $tarea->fechaInicioSolucion  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Fin Solucion:</b>
                @if(! is_null( $tarea->fechaFinSolucion )) {{ $tarea->fechaFinSolucion  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Tiempo Solucion:</b>
                @if(! is_null( $tarea->tiempoSolucion )) {{  $tarea->tiempoSolucion  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Estado:</b>

                    <label  style="background: {{$tarea->estados->color}}; color:{{$tarea->estados->texto}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{$tarea->estados->nombre}} </label>
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Ubicaciones:</b>

                    <ul style="padding: 10px;">
                        @foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
                            <li>{{ $ubicacion->nombre }} </li>
                        @endforeach
                    </ul>
            </div>

            <div style="text-align: center;  padding: 10px;">
                <b class="text-right" style="width: 50%">Observacion:</b>
                {{$tarea->getObservacion() }}
            </div>
        </div>
        <div class="modal-footer modal-delete-footer" >
          <a  data-dismiss="modal" class="btn btn-danger btn-xs" ><span class="fa fa-times"></span> Cerrar</a>
        </div>
      </div>
    </div>

  </div>
</div>
