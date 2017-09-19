<div class="panel panel-default" id="formNuevaTarea">

  <div class="panel-heading">
    <p class="titulo-panel">Tarea Agenda</p>
  </div>

  <div class="panel-body">

      <b > Los campos con (*) son obligatorios </b>

      {!! Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST']) !!}
      <input type="number" name="estimados" value="0" hidden>

     {{-- Descripcion --}}
      <div class="form-group">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4
            @if ($errors->has('descripcion')) has-error @endif">
            <label>Descripcion *</label>
              <input type="text" minlength="5" value="{{ old('descripcion') }}" style="margin-bottom: 15px;"
                   maxlength="60" name="descripcion" placeholder="Descripcion"  diaInicio="{{ \Cache::get('diaInicio') }}"
                   class="form-control" required>
          @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
          </div>
      </div>

{{-- Fechas de Inicio y Fin --}}
<div class="form-group col-xs-12 row"   >
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaInicioEstimado'))
            has-error
        @endif">

        <label>Fecha Inicio *: </label>

        <input-date tipo="text" nombre="fechaInicioEstimado"  diaInicio="{{ \Cache::get('diainicio') }}"
                    valor="{{ old('fechaInicioEstimado') }}" placeholder="dd/mm/aaaa"
                    fechainicio="{{  $semanas->fechaInicio }}"
                    fechafin='{{ $semanas->fechaFin }}' >
        </input-date>
        @if ($errors->has('fechaInicioEstimado'))
            <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p>
        @endif
    </div>

    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaFinEstimado'))
            has-error
        @endif">

        <label>Fecha Fin *: </label>

        <input-date tipo="text" nombre="fechaFinEstimado"  diaInicio="{{ \Cache::get('diainicio') }}"
                    valor="{{ old('fechaFinEstimado') }}" placeholder="dd/mm/aaaa"
                    fechainicio="{{  $semanas->fechaInicio }}"
                    fechafin='{{ $semanas->fechaFin }}' >

        </input-date>
        @if ($errors->has('fechaFinEstimado'))
            <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p>
        @endif
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;" v-if="false">
        <span id="observacion" style="color: green; font-weight: bold;"></span>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="false">
        <div class="checkbox">
            <label>
                <input  type="checkbox" name="todasemana"  id="default-fechaEstimadas">
                Utilizar fechas de la semana
            </label>
        </div>
    </div>
</div>

  {{-- Tiempo estimado --}}
  <div class="col-sm-12 row" >
      <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('hora')) has-error @endif">
          Horas:
          <input type="number" min="0"  name="hora" max="150" placeholder="Horas" v-model="tarea.hora"
                 value="{{ old('hora') }}" class="form-control"
                 required >
          @if ($errors->has('hora'))
              <p class="help-block">{{ $errors->first('hora') }}</p>
          @endif
      </div>

      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('minuto')) has-error @endif">
          Minutos:
          <input type="number" min="0" name="minuto" max="999"
                 class="form-control" value="{{ old('minuto') }}"  placeholder="Minutos"
                 v-model="tarea.minuto" required>

          @if ($errors->has('minuto'))
              <p class="help-block">{{ $errors->first('minuto') }}</p>
          @endif
      </div>
  </div>

{{-- Fin body  model --}}
</div>
  <div class="panel-footer text-right">
      <a  id="cancelar"
          @click="hideNuevaTareaAgenda($event)"
          class="btn btn-danger"
          type="reset"><span class="fa fa-times">
          </span> Cancelar</a>

      <button type="submit" name="guardar"  class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
  </div>
{!! Form::close()!!}
</div>


<script>
    $('#default-fechaEstimadas').click(function () {
        var fechaInicio = $('input[name=fechaInicioEstimado]');
        var fechaFin = $('input[name=fechaFinEstimado]');
        var mensaje = $('#observacion');


        if(this.checked){
            fechaInicio.attr('disabled', true);
            fechaFin.attr('disabled', true);

            mensaje.html('La tarea esta programada para toda la semana.');
        }else{
            fechaInicio.attr('disabled', false);
            fechaFin.attr('disabled', false);

            mensaje.html('');
        }
    });

</script>


