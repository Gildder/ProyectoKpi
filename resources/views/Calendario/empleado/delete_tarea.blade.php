
   <!-- Modal -->
<div class="modal fade" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-tarea-calendario" style="z-index:2000">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-delete-content ">
        <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eliminar Tarea</h4>
        </div>

        <form>
        <div class="modal-body">

            <div class="modal-body">
                <p>¿Estas seguro que deseas eliminar la tarea?</p>
                <input type="text" hidden id="idTaraeEliminar">
            </div>
        </div>

        {{-- Footer de Modal --}}
        <div class="modal-footer">
            <button data-dismiss="modal"  @click="cancelarElimnarTarea($event)"
                class="btn btn-danger"
                type="reset"><span class="fa fa-times">
                </span> Cancelar </button>

            <button type="submit" name="guardar"  @click="eliminarTarea($event)" class="btn btn-success"><span class="fa fa-check"></span> Aceptar</button>
        </div>
        </form>
    </div>

    </div>
</div>


