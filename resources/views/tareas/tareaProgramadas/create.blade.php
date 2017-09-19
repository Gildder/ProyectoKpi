<div class="panel panel-default" id="formNuevaTarea">
    <div class="panel-heading">
        <p class="titulo-panel">Nueva Tarea <b></b> </p>
    </div>
  <div class="panel-body">

      {!! Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST']) !!}
     {{-- Descripcion --}}
      <div class="form-group">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4
            @if ($errors->has('descripcion')) has-error @endif">
            <label>Descripcion *:</label>
            <input type="text" minlength="5" value="{{ old('descripcion') }}"
                   maxlength="120" name="descripcion" placeholder="Descripcion" class="form-control stylDescripcion" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
          </div>
      </div>

{{-- Fechas de Inicio y Fin --}}
<div class="form-group col-xs-12 row" >
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaInicioEstimado'))
            has-error
        @endif">

        <label>Fecha Inicio *: </label>
        <input-date tipo="text" nombre="fechaInicioEstimado"
                    valor="{{ old('fechaInicioEstimado') }}"
                    placeholder="dd/mm/aaaa"  diaInicio="{{ \Cache::get('diainicio') }}"
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
                    valor="{{ old('fechaFinEstimado') }}"
                    placeholder="dd/mm/aaaa"
                    fechainicio="{{  $semanas->fechaInicio }}"
                    fechafin='{{ $semanas->fechaFin }}' >

        </input-date>
        @if ($errors->has('fechaFinEstimado'))
            <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p>
        @endif
    </div>

</div>


  {{-- Tiempo estimado --}}
  <div class="col-sm-12 row" >
      <label class="form-group col-sm-12 col-xs-12">Duracion *:</label>
      <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('hora')) has-error @endif">
          Horas:
          <input type="number" min="0"  name="hora" max="150" placeholder="Horas"
                 id="hora" v-model="tarea.hora"
                 value="0" class="form-control"  diainicio="{{ \Cache::get('diaInicio') }}"
                 required >
          @if ($errors->has('hora'))
              <p class="help-block">{{ $errors->first('hora') }}</p>
          @endif
      </div>

      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('minuto')) has-error @endif">
          Minutos:
          <input type="number" min="0" name="minuto" max="999"     id="minuto" v-model="tarea.minuto"
                 class="form-control" value="0"  placeholder="Minutos"
                 required>

          @if ($errors->has('minuto'))
              <p class="help-block">{{ $errors->first('minuto') }}</p>
          @endif
      </div>
  </div>

{{-- Fin body  model --}}
</div>
  <div class="panel-footer text-right">
      <a  id="cancelar" @click="hideNuevaTarea($event)"
          class="btn btn-danger"
          type="reset"><span class="fa fa-times">
          </span> Cancelar</a>

      <button type="submit" name="guardar"
              class="btn btn-success"><span
                  class="fa fa-save"></span>  Guardar</button>
  </div>
{!! Form::close()!!}
</div>

<style type="text/css">
    .stylDescripcion {
        margin-bottom: 15px;
    }
</style>

<script>

    $('#hora').change(function () {
        if($(this).val() > 0){
            $('#minuto').removeAttr('required');
        } else {
            $('#minuto').attr('required', true);
        }
    });

    $('#hora').keyup(function () {
        if ($(this).val() > 0) {

            $('#minuto').removeAttr('required');
        }
        else
        {
            $('#minuto').attr('required');
        }
    });


    $('#minuto').change(function () {
        if($(this).val() > 0){
            $('#hora').removeAttr('required');
        }else{
            $('#hora').attr('required');
        }
    });

    $('#minuto').keyup(function () {
        if($(this).val() > 0){
            $('#hora').removeAttr('required');
        }else{
            $('#hora').attr('required');
        }
    });



</script>

