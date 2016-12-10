<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="	padding-bottom: 5px; background: #3c8dbc;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      	<h3 class="modal-title" >Indicador</h3>
      </div>
      <div class="modal-body">
           {!!Form::open()!!}
            <div class="modal-body">
              <h3>¿Estas seguro que deseas eliminar?</h3><br>
                  <div class="form-group col-sm-5 ">
                        <label id="nombregrupo"></label>
                  </div>
            </div>
            <div class="modal-footer">
                  {!! form::submit('Aceptar',['name'=>'Aceptar','id'=>'aceptar','content'=>'<span>Aceptar</span>','class'=>'btn btn-success navbar-btn']) !!}
                  <button type="button" data-dismiss="modal" class="btn btn-danger navbar-btn">Cancelar</button>
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>