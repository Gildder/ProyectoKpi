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
            <b class="text-right" style="width: 50%">No.:</b>
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
            @if(! is_null( $tarea->nombres )) {{ $tarea->nombres  }} @else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Correo Electronico:</b>
            @if(! is_null( $tarea->correo )) {{ $tarea->correo  }} @else '' @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Cargo:</b>
            @if(! is_null( $tarea->cargo )) {{ $tarea->cargo  }} @else '' @endif
          </div>


          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Departamento:</b>
            @if(! is_null( $tarea->departamento )) {{ $tarea->departamento  }} @else '' @endif
          </div>


          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Localizacion:</b>
            @if(! is_null( $tarea->localizacion )) {{ $tarea->localizacion  }} @else '' @endif
          </div>

          @if($tarea->vacacion != '')
            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
              <b class="text-right" style="width: 50%">Vacacion:</b>
              <span class="badge bg-green-gradient"><i class="fa fa-check"></i>  Si</span>
            </div>
          @endif

          @if($tarea->bloqueado != '')
            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
              <b class="text-right" style="width: 50%">Bloqueado:</b>
              <span class="badge bg-green-gradient"><i class="fa fa-check"></i>  Si</span>
            </div>
          @endif

          @if($tarea->activo != '')
            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
              <b class="text-right" style="width: 50%">Activo:</b>
              <span class="badge bg-red-gradient"><i class="fa fa-check"></i>  No</span>
            </div>
          @endif

        </div>
        <div class="modal-footer modal-delete-footer">
        </div>
      </div>
    </div>

  </div>
</div>
