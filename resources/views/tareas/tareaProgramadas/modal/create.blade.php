
   <!-- Modal -->
<div class="modal fade" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nueva-tarea" style="z-index:2000">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-delete-content ">
        <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nueva Tarea</h4>
        </div>
        <form id="formNuevaTarea" class="form-group">
        <div class="modal-body">

            {{-- Contenido del Modal --}}
            <p> Los campos con (*) son obligatorios </p>
            @verbatim
                <div hidden>
                    {{ cargarDatosNuevaTarea() }}
                </div>
            @endverbatim


            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="agenda" value="{{ $agenda }}" hidden>
            <input type="text" name="fechaInicioParam" value="{{ $semanas->fechaInicio }}" hidden>
            <input type="text" name="fechaFinParam" value="{{ $semanas->fechaFin }}" hidden>

            {{-- Descripcion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group @if ($errors->has('descripcion')) has-error @endif">
                    <label>Descripcion *:</label>
                    <input type="text" class="form-control margenDescripcion"
                           minlength="5"  id="nuevaTareaDescripcion" v-model="tareaNueva.descripcion"
                           maxlength="120" name="descripcion" placeholder="Ingrese Tarea"
                           required>
                </div>
            </div>

            {{-- Fechas de Inicio y Fin --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row"  style="display:{{ (\Usuario::get('verFechaEstimadas')== true || $agenda === '1')?'block':'none'}}">
                {{-- Fecha Inicio de Tarea --}}
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group @if ($errors->has('fechaInicioEstimado')) has-error @endif">
                        <label>Fecha Inicio *: </label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaInicioTarea"  style="z-index: 3000"
                                   v-model="tareaNueva.fechaInicio"   :key="cambioFecha"
                                   placeholder="Fecha Inicio" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="form-control" name="fechaInicio" required>
                        </div>
                    </div>
                </div>

                {{-- Fecha Fin de Tarea --}}
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group @if ($errors->has('fechaFinEstimado')) has-error @endif">
                        <label>Fecha Fin *: </label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaFinTarea"  style="z-index: 3000"
                                   v-model="tareaNueva.fechaFin"   :key="cambioFecha"
                                   placeholder="Fecha Fin" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="form-control" name="fechaFin" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Duracion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row" >
                <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Duracion:</label>

                {{-- Horas --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group @if ($errors->has('hora')) has-error @endif">
                        Horas *:
                        <input type="number" min="0"  name="hora" max="150" placeholder="Horas"
                               v-model="tareaNueva.hora" class="form-control"
                               required >
                    </div>
                </div>

                {{-- Minutos --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group @if ($errors->has('minuto')) has-error @endif">
                        Minutos *:
                        <input type="number" min="0" name="minuto" max="999"
                               v-model="tareaNueva.minuto"
                               class="form-control"  placeholder="Minutos" required>
                    </div>
                </div>
            </div>


        </div>

        {{-- Footer de Modal --}}
        <div class="modal-footer">
            <button type="reset"  @click="cancelarNuevaTarea($event)"
                class="btn btn-danger">
                <span class="fa fa-times"></span>
                Cancelar
            </button>

            <button  class="btn btn-success" type="submit"
                     :disabled="verificarValidarTareanueva"
                    @click="guardarTareaNueva($event)">
                <span class="fa fa-save"></span>
                Guardar
            </button>
        </div>
        </form>
    </div>

    </div>
</div>

   <style>
       .margenFecha {
           margin: 10px 5px 15px 0px;
       }

       .margenDescripcion {
           margin-bottom: 15px;
       }
   </style>
<script>
    var fechaInicioModal;
    var fechaFinModal;

    $(document).ready(function () {
        $('input[name=agenda]').val(sessionStorage.getItem('agendas'));

        /* eventos de las tareas */
        $("#modal-nueva-tarea").on('hidden.bs.modal', function () {
            $('#formNuevaTarea')[0].reset();

            $('input[name="hora"]').val(0);
            $('input[name="minuto"]').val(0);
        });

        fechaInicioModal = $('input[name="fechaInicioParam"]').val();
        fechaFinModal = $('input[name="fechaFinParam"]').val();

        cargarFechaFinTarea(fechaInicioModal, fechaFinModal);
        cargarFechaInicioTarea(fechaInicioModal, fechaFinModal);
    });

    function cargarFechaInicioTarea(fechaInicioModal, fechaFinModal) {

        $("#fechaInicioTarea").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            showWeek: false,
            numberOfMonths: verificarFinSiHayFinMes(),
            firstDay: 1,
            showButtonPanel: true,
            minDate: fechaInicioModal,
            maxDate: fechaFinModal,
            selectOtherMonths: true,
            showAnim: 'fadeIn',
            beforeShowDay: false,
        });
    }

    function cargarFechaFinTarea(fechaInicioModal, fechaFinModal) {

        $("#fechaFinTarea").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            showWeek: false,
            numberOfMonths: verificarFinSiHayFinMes(),
            firstDay:1,
            showButtonPanel: true,
            minDate: fechaInicioModal,
            maxDate: fechaFinModal,
            selectOtherMonths: true,
            showAnim: 'fadeIn',
            beforeShowDay: false,
        });
    }

    /* retorna 1 o 2 para la candidad de mes a mostra por el datapícker*/
    function verificarFinSiHayFinMes() {
        var arrayFechaInicio = fechaInicioModal.split('/');
        var arrayFechaFin = fechaFinModal.split('/');

        var mesInicio = parseInt(arrayFechaInicio[1]);
        var mesFin = parseInt(arrayFechaFin[1]);
        if(mesInicio !== mesFin){
            return 2;
        }else{
            return 1;
        }
    }



</script>
