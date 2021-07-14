<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
   <!-- Modal -->
<div class="modal fade" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nueva-tarea" style="z-index:2000">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-delete-content ">
        <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@lang('labels.titlesPage.createTarea')</h4>
        </div>

        <form id="formNuevaTarea" method="post" class="form-group" @submit="guardarTareaNueva($event)">

        <div class="modal-body">

            <div class="col-sm-12">
                <p>Tareas Programadas de <b class="fechaTareas" id="limFechaInicio"></b> al
                    <b class="fechaTareas" id="limFechaFin"></b></p>
                <p>@lang('labels.comments.obligatorioAttr')</p>
            </div>
            {{-- Contenido del Modal --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="fechaInicioParam" value="{{ $semanas->fechaInicio }}" hidden>
            <input type="text" name="fechaFinParam" value="{{ $semanas->fechaFin }}" hidden>

            {{-- Descripcion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label>Descripcion *:</label>
                    <input type="text" class="form-control margenDescripcion"
                           minlength="@lang('labels.strlens.lenMinDesc')"
                           maxlength="@lang('labels.strlens.lenMaxDesc')"
                           id="nuevaTareaDescripcion"
                           v-model="tareaNueva.descripcion"
                           name="descripcion"
                           placeholder="@lang('labels.pladers.phsDescripcion')"
                           required>
                    <span class="help-block"></span>
                </div>
            </div>

            {{-- Fechas de Inicio y Fin --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row"  style="display:{{ (\Usuario::get('verFechaEstimadas')== true || $agenda === '1')?'block':'none'}}">
                {{-- Fecha Inicio de Tarea --}}
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group" id="divFechaInicio">
                        <label>@lang('labels.labels.lbsFechaInicio')</label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaInicioTarea"  style="z-index: 3000"
                                   v-model="tareaNueva.fechaInicio"
                                   placeholder="@lang('labels.pladers.phsFechaInicio')"
                                   class="form-control"
                                   name="fechaInicio" required>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>

                {{-- Fecha Fin de Tarea --}}
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group" id="divFechaFin">
                        <label>@lang('labels.labels.lbsFechaFin')</label>
                        <div class="input-group row margenFecha">
                            <div class="input-group-addon row">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="fechaFinTarea"  style="z-index: 3000"
                                   v-model="tareaNueva.fechaFin"
                                   placeholder="@lang('labels.pladers.phsFechaFin')"
                                   class="form-control" name="fechaFin" required>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <a href="#" class="btn btn-primary btn-sm btnRefreshDate" id="refrescarAgendaFechas"
                   title="Limpiar Fechas" ><i class="fa fa-repeat"></i></a>
            </div>

            {{-- Duracion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row" >
                {{-- Horas --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="hora">@lang('labels.labels.lbsHora')</label>
                        <input type="number" min="0"
                               name="hora" max="150"
                               placeholder="@lang('labels.pladers.phsHora')"
                               v-model="tareaNueva.hora"
                               pattern="@lang('labels.patterns.ptsNumero')"
                               class="form-control"
                               required >
                        <span class="help-block"></span>
                    </div>
                </div>

                {{-- Minutos --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="minuto">@lang('labels.labels.lbsMinuto')</label>
                        <input type="number" min="0"
                               name="minuto" max="9999"
                               v-model="tareaNueva.minuto"
                               pattern="@lang('labels.patterns.ptsNumero')"
                               class="form-control"
                               placeholder="@lang('labels.pladers.phsMinuto')" required>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer de Modal --}}
        <div class="modal-footer" >
            <button type="reset"  @click="cancelarNuevaTarea($event)"
                    class="@lang('labels.stylbtns.btnCancelar')">
                <span class="@lang('labels.icons.icoCancel')"></span>
                @lang('labels.buttons.btnCancelar')
            </button>

            <button  class="@lang('labels.stylbtns.btnGuardar')"
                     type="submit" id="btn_save_tarea"
                     :disabled="verificarValidarTareanueva">
                <span class="@lang('labels.icons.icoSave')"></span>
                @lang('labels.buttons.btnGuardar')
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
       .btnRefreshDate {
           position: absolute;
           float: right;
           top: 35px;
           right: -10px;
       }
   </style>
<script>
    var agenda;
    $(document).ready(function () {
        let fechaInicio = $('input[name="fechaInicioParam"]').val();
        let fechaFin = '31/12/'+new Date().getFullYear();
        // todo:este valor tiene que ser configurable desde el servidor, por la gerencia evaluadore
        sessionStorage.setItem('inicioSemana', fechaInicio);
        sessionStorage.setItem('finSemana', fechaFin);

        $("#fechaInicioTarea").val(fechaInicio);
        $("#fechaFinTarea").val(fechaFin);

        cargarFechasDataPickerRefresh("fechaInicioTarea", 0);
        cargarFechasDataPickerRefresh("fechaFinTarea", 1);

        limpiarForm();
        
    });


    $("#modal-nueva-tarea").on('hidden.bs.modal', function () {
        limpiarForm();
    });

    function limpiarForm() {
        $('form')[0].reset();

        $('input[name="hora"]').val(0);
        $('input[name="minuto"]').val(0);
    
        //Escondemos todos los avisos.
        $('span.help-block').hide();

        // removemos las alertas de labels
        $('div.has-error').removeClass('has-error');

        RefrescarDatePicker();
    }

    function RefrescarDatePicker() {
        let fechaInicio = $('input[name="fechaInicioParam"]').val();
        let fechaFin = '31/12/'+new Date().getFullYear();
        // todo:este valor tiene que ser configurable desde el servidor, por la gerencia evaluadore
        sessionStorage.setItem('inicioSemana', fechaInicio);
        sessionStorage.setItem('finSemana', fechaFin);

        actualizarFechasCalendario('fechaInicioTarea');
        actualizarFechasCalendario('fechaFinTarea');
        
        $('#limFechaInicio').html(fechaInicio);
        $('#limFechaFin').html(fechaFin);

        $("#fechaInicioTarea").val('');
        $("#fechaFinTarea").val('');

        $("#divFechaInicio").removeClass('has-error');
        $("#divFechaFin").removeClass('has-error');

        $("#divFechaFin").children('span')
            .removeClass('help-block')
            .html('')
            .hide();

        $("#divFechaInicio").children('span')
            .removeClass('help-block')
            .html('')
            .hide();
    }
    
   $('#refrescarAgendaFechas').click(function () {
       mostrarCargando(true);

       RefrescarDatePicker();

       mostrarCargando(false);


   });

    

    $('input[name="descripcion"]').blur(function(){
        if(validarCampoVacio($(this).val())){
            validarLimitesString(5, 120, $(this));
        }else{
            mostrarErrorForm($(this), 'La descripcion es requerida');
        }
    });

    $('input[name="hora"]').blur(function(){
        if(validarCampoVacio($(this).val())){
            ocultarErrorForm($(this));
        }else{
//            mostrarErrorForm($(this), 'La hora es requerida');
            $(this).val(0);
        }

    });

    $('input[name="minuto"]').blur(function(){
        if(validarCampoVacio($(this).val())){
            ocultarErrorForm($(this));
        }else{
//            mostrarErrorForm($(this), 'El minuto es requerida');
            $(this).val(0);
        }
    });

    
    
</script>
