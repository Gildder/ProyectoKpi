
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$evaluador->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar Evaluador
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Evaluadores\EvaluadorController@destroy', $evaluador->id], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar a <b>{{$evaluador->abreviatura}} {{$evaluador->descripcion}}?</b></p>
                  <div class="form-group col-sm-5 ">
                        <label id="nombregrupo"></label>
                  </div>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a href="javascript:void(0)"  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
                <button type="submit" @click="mostrarModalLoading()"  class="btn btn-success guardar" type="reset"><span class="fa fa-check"></span> Aceptar</button>

            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>


   <script>
       $(document).ready(function(){

           $("#formEvaluador  input,select").change(function () {
               let form = $(this).parents("#formEvaluador");
               let check = checkCampos(form);
               if (check) {
                   $(".guardar").prop("disabled", false);
               }
               else {
                   $(".guardar").prop("disabled", true);
               }
           });

           //Función para comprobar los campos de texto
           function checkCampos(obj) {
               var camposRellenados = false;
               cantidad = 0;
               obj.find("input").each(function () {
                   let $this = $(this);
                   if ($this.val().length > 0) {
                       cantidad ++;
                       console.log($this.val().length);

                       camposRellenados = true;
                       return true;
                   }else {
                       if(cantidad >0)
                           cantidad--;
                   }
               });
               if (camposRellenados && cantidad === 3) {
                   return true;
               }
               else {
                   return false;
               }
           }

       });
   </script>
