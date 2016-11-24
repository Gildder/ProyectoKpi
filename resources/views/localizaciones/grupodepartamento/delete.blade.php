
   <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
<script>
/*
      function Eliminar(id)
      {
            /*
            if(confirm('¿Estas seguro que desea Eliminar '+id+' - ' +nombre+ '?'))
            {
                  var route = "{{url('localizaciones/grupodepartamento/destroy')}}/"+ id;
                  alert(route);
                  document.location.href = route;
            }

            var route = "{{url('localizaciones.grupodepartamento.destroy')}}/"+id;
            $.get(route, function(data){
                  $('#nombregrupo').val(data.nombre);
            });
*/
            
      }


</script>

