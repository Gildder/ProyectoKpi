<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar Cargo
      </div>
      <div class="modal-body">
           {!!Form::open()!!}
            <div class="modal-body" style="padding: 0">
              <h4>¿Estas seguro que deseas eliminar?</h4><br>
            </div>
            <div class="modal-footer text-right" style="padding: 0">
                  {!! form::submit('Aceptar',['name'=>'Aceptar','id'=>'aceptar','content'=>'<span>Aceptar</span>','class'=>'btn btn-success']) !!}
                  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right">Cancelar</button>
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>

