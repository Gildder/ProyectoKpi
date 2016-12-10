<div id="myModal" class="modal fade"  tabindex="-1"  role="dialog"  aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc;">
        <button type="button" style="color: white; height: 100%;" class="close  pull-right" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="margin: 0; color: white; font-weight: bold;">Agregar Nuevo Puesto</h3>
      </div>
      <div class="modal-body">
           {!!Form::open()!!}
            <div class="modal-body">
              <h4>Seleccione un puesto</h4><br>
                  <div class="form-group col-sm-5 ">
                    @foreach($nuevocargos as $indicador)
          						 <label id="nombregrupo">{{$indicador->nombre}}</label>
          					@endforeach
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
<script>