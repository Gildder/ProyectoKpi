
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-tarea-Calendario">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b id="modalTareaTitle" class="modal-title"></b>
      </div>
      <div class="modal-body modal-delete-body">
          <form action="" id="verDetalleTarea" method="post">
      </div>
      <div class="modal-body modal-delete-body">
          <form action="" id="verDetalleTarea" method="post">
          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">No. Tarea:</b>
              <p id="modalTareaNro"></p>
              <p id="idTarea" hidden></p>
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">Descripcion:</b>
              <p id="modalTareaDesc"></p>
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">Fecha Inicio:</b>
              <p id="modalTareaFchIn"></p>
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">Fecha Fin:</b>
              <p id="modalTareaFchFn"></p>
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">Tiempo:</b>
              <p id="modalTareaTmp"></p>
          </div>

          <div style="text-align: center; border-bottom: 1px solid lightgrey; padding: 5px;">
              <b class="text-right" style="width: 50%">Estado:</b>
              <label id="modalTareaStd" class="textEstado"></label>
          </div>

          <div class="modal-footer modal-delete-footer">
              <a  data-dismiss="modal" class="btn btn-danger" >Cerrar   <span class="fa fa-times"></span> </a>
              {{--<button type="submit"   name="ver" class="btn btn-success">Ver Tarea  <span class="fa fa-eye"></span> </button>--}}
          </div>
          </form>
      </div>
    </div>

  </div>
</div>

   <style class="text/css">
       .textEstado{
           font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray;
       }
   </style>
