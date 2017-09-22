
   <!-- Modal -->
<div class="modal fade" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nueva-tarea" style="z-index:2000">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-delete-content ">
        <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nueva Tarea</h4>
        </div>
        <div class="modal-body">

            {{-- Contenido del Modal --}}
            <p> Los campos con (*) son obligatorios </p>

            {!! Form::open(['method'=>'POST', 'id'=> 'formNuevaTarea']) !!}
            <input type="text" name="agenda" value="{{ $agenda }}" hidden>


            {{-- Descripcion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group @if ($errors->has('descripcion')) has-error @endif">
                    <label>Descripcion *:</label>
                    <input type="text" minlength="5" value="{{ old('descripcion') }}" style="margin-bottom: 15px;" id="nuevaTareaDescripcion"
                           maxlength="60" name="descripcion" placeholder="Coloca tu tarea"  diaInicio="{{ \Cache::get('diaInicio') }}"
                           class="form-control" required>
                </div>
            </div>

            {{-- Fechas de Inicio y Fin --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row"  style="display:{{ (\Usuario::get('verFechaEstimadas')== true || $agenda === '1')?'block':'none'}}">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group @if ($errors->has('fechaInicioEstimado')) has-error @endif">
                        <label>Fecha Inicio *: </label>
                        <input-date tipo="text" nombre="fechaInicioEstimado"  diaInicio="{{ \Cache::get('diainicio') }}"
                                    valor="{{ old('fechaInicioEstimado') }}" placeholder="dd/mm/aaaa" agendar="{{ $agenda }}"
                                    fechainicio="{{  $semanas->fechaInicio }}"
                                    fechafin='{{ $semanas->fechaFin }}' >
                        </input-date>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group @if ($errors->has('fechaFinEstimado')) has-error @endif">
                        <label>Fecha Fin *: </label>
                        <input-date tipo="text" nombre="fechaFinEstimado"  diaInicio="{{ \Cache::get('diainicio') }}"
                                    valor="{{ old('fechaFinEstimado') }}" placeholder="dd/mm/aaaa" agendar="{{ $agenda }}"
                                    fechainicio="{{  $semanas->fechaInicio }}"
                                    fechafin='{{ $semanas->fechaFin }}' >
                        </input-date>
                    </div>
                </div>
            </div>

            {{-- Duracion --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row" >
                <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Duracion*:</label>

                {{-- Horas --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group @if ($errors->has('hora')) has-error @endif">
                        Horas:
                        <input type="number" min="0"  name="hora" max="150" placeholder="Horas"
                               value="{{ old('hora') }}" class="form-control" id="hora"
                               required >
                    </div>
                </div>

                {{-- Minutos --}}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group @if ($errors->has('minuto')) has-error @endif">
                        Minutos:
                        <input type="number" min="0" name="minuto" max="999" id="minuto"
                               class="form-control" value="{{ old('minuto') }}"  placeholder="Minutos" required>
                    </div>
                </div>
            </div>
            {{-- Fin body  model --}}

        </div>

        {{-- Footer de Modal --}}
        <div class="modal-footer">
            <button  @click="cancelarNuevaTarea($event)"
                class="btn btn-danger"
                type="reset"><span class="fa fa-times">
                </span> Cancelar </button>

            <button type="submit" name="guardar"  class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
        </div>
        {!! Form::close()!!}
    </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        /* eventos de las tareas */
        $("#modal-nueva-tarea").on('hidden.bs.modal', function () {
            $('#formNuevaTarea')[0].reset();

            $('#hora').val(0);
            $('#minuto').val(0);
        });


        $('#hora').val(0);
        $('#minuto').val(0);
    });




</script>
