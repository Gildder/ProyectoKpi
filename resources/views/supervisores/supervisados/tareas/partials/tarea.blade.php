<!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog"  id="modal-tareaDetalle-{{$tarea->tarea_id }}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Tarea Nro. {{ $tarea->nro }} de {{ $tarea->usuario  }}</b>
      </div>
      <div class="modal-body modal-delete-body">
        <div class="modal-body">

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Tarea:</b>
                <p> @if(! is_null($tarea->descripcion)) {{ $tarea->descripcion  }}@else '' @endif</p>
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Inicio:</b>
                @if(! is_null( $tarea->fechaInicio )) {{ $tarea->fechaInicio  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Fecha Fin:</b>
                @if(! is_null( $tarea->fechaFin )) {{ $tarea->fechaFin  }} @else '' @endif
            </div>

            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Tiempo:</b>
                @if(! is_null( $tarea->tiempo )) {{  $tarea->tiempo  }} @else '' @endif
            </div>


            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
                <b class="text-right" style="width: 50%">Estado:</b>

                    <label  style="background: {{$tarea->colorEstado}}; color:{{$tarea->textoEstado}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{$tarea->estado}} </label>
            </div>




        </div>
        <div class="modal-footer modal-delete-footer" >
        </div>
      </div>
    </div>

  </div>
</div>
