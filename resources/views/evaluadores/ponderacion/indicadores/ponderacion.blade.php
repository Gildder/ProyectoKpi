
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-indicador-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b> Agregar Ponderacion</b>
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Evaluadores\PonderacionController@agregarindicador',  $item->id,  $ponderacion->id], 'method'=>'GET'])!!}

            <div class="modal-body">
              <p>Agregar la Ponderacion para el Indicador <b>{{$item->nombre}}?</b></p>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="nombre" >Ponderacion</label>
                <input  type="number" min="0" max="{{ $ponderacion->ponderacionIndicador($ponderacion->id)}}" value="{{ $ponderacion->ponderacionIndicador($ponderacion->id) }}" name="ponderacion" placeholder="Valor de  ponderacion" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a href="javascript:void(0)"  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>

              @if($ponderacion->ponderacionIndicador($ponderacion->id) != 0)
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}

              @else
                  {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit', 'disabled'=> 'disabled' ]) !!}

              @endif
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>

