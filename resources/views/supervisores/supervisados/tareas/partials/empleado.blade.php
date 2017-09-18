
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-usuarioTarea-{{$tarea->user_id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Datos Usuario</b>
      </div>
      <div class="modal-body modal-delete-body">
        <div class="modal-body">
          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">No. Usuario:</b>
            @if(! is_null($tarea->user_id)) {{ $tarea->user_id }}@else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Codigo:</b>
            @if(! is_null($tarea->codigo)) {{ $tarea->codigo  }}@else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Usuario:</b>
            @if(! is_null($tarea->usuario)) {{ $tarea->usuario  }}@else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Nombre Completo:</b>
            @if(! is_null( $tarea->nombres )) {{ $tarea->nombres  }} @else '' @endif    @if(! is_null( $tarea->apellidos )) {{ $tarea->apellidos  }} @else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Correo Electronico:</b>
            @if(! is_null( $tarea->email )) {{ $tarea->email  }} @else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Cargo:</b>
            @if(! is_null( $tarea->cargo )) {{ $tarea->cargo  }} @else '' @endif
          </div>


          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Departamento:</b>
            @if(! is_null( $tarea->departamento )) {{ $tarea->departamento  }} @else '' @endif
          </div>


          <div style="text-align: center;  padding: 10px;">
            <b class="text-right" style="width: 50%">Localizacion:</b>
            @if(! is_null( $tarea->localizacion )) {{ $tarea->localizacion  }} @else '' @endif
          </div>

        </div>
        <div class="modal-footer modal-delete-footer">
          <a  data-dismiss="modal" class="btn btn-danger btn-xs" ><span class="fa fa-times"></span> Cerrar</a>
        </div>
      </div>
    </div>

  </div>
</div>
