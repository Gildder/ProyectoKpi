<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-usuarioTarea-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Datos Empleado</b>
      </div>
      <div class="modal-body modal-delete-body">
        <div class="modal-body">
          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">No.:</b>
            @if(isset($item->id)) {{ $item->id }} @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Codigo:</b>
            @if(isset($item->codigo)) {{ $item->codigo  }} @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Usuario:</b>
            @if(isset($item->usuario)) {{ $item->usuario  }} @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Nombre Completo:</b>
            @if(isset( $item->nombres )) {{ $item->nombres  }}  {{ $item->apellidos  }}   @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Correo Electronico:</b>
            @if(isset( $item->correo )) {{ $item->correo  }}  @endif
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Cargo:</b>
            @if(isset( $item->cargo )) {{ $item->cargo  }}  @endif
          </div>


          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Departamento:</b>
            @if(isset( $item->departamento )) {{ $item->departamento  }}  @endif
          </div>


          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
            <b class="text-right" style="width: 50%">Localizacion:</b>
            @if(isset( $item->localizacion )) {{ $item->localizacion  }}  @endif
          </div>

          @if($item->is_evaluador == 1)
            <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 10px;">
              <b class="text-right" style="width: 50%">Evaluador de:</b>
                <p>
                @foreach($evaluador::evaluadorasEmpleado($item->id) as $gerencia)
                    <span><b class="badge bg-default">{{ $gerencia->id }}</b> {{$gerencia->abreviatura}}</span><br>
                 @endforeach
                </p>
            </div>
          @endif


        </div>
        <div class="modal-footer modal-delete-footer">
        </div>
      </div>
    </div>

  </div>
</div>
