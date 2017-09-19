

<!-- Nuevo -->
<div class="panel panel-default"  id="formEditarTarea">
  <div class="panel-heading">
    <p class="titulo-panel">Editando Tarea <b></b> </p>
  </div>

  <div class="panel-body">

      {{--{!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT'])!!}--}}
      {{--{!! Form::hidden('id' ) !!}--}}

{{-- Descripcion --}}
<div class="">
  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5
    @if ($errors->has('descripcion'))
          has-error
    @endif">

    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5"
            maxlength="120" name="descripcion" placeholder="Descripcion"
            placeholder="Descripcion" class="form-control" value=""
            required>
    @if ($errors->has('descripcion'))
      <p class="help-block">{{ $errors->first('descripcion') }}</p>
    @endif
  </div>
</div>

{{-- Fecha de Estimada --}}
<div class="form-group col-xs-12 row">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaInicio'))
          has-error
        @endif">

        <label>Fecha de Inicio *: </label>
        <div class="input-group row" style="margin: 10px 5px 15px 0px;">
            <div class="input-group-addon row">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" id="fechaInicio" value="" placeholder="Fecha Inicio" class="form-control" name="fechaInicio" required>
        </div>
        @if ($errors->has('fechaInicio'))
          <p class="help-block">{{ $errors->first('fechaInicio') }}</p>
        @endif
    </div>

    <div class=" col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaFin'))
                  has-error
        @endif">
        <label >Fecha de Fin *: </label>

        <div class="input-group row" style="margin: 10px 5px 15px 0px;">
            <div class="input-group-addon row">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" id="fechaFin" value="" placeholder="Fecha Fin" class="form-control" name="fechaFin" required>
        </div>
        @if ($errors->has('fechaFin'))
          <p class="help-block">{{ $errors->first('fechaFin') }}</p>
        @endif
    </div>
    <div v-if="false" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
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

{{-- estado --}}
<div class="row col-sm-12">
  <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-3">
      <label >Estado </label>
      <select class="form-control" name="estado">
          <option value="" >Seleccionar...</option>
      </select>
  </div>
</div>

{{-- Tiempo estimado --}}
<div class="row col-sm-12">
  <label class="form-group col-sm-12 col-xs-12">Tiempo *</label>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('hora'))
              has-error
        @endif">
        <p>Horas:<p>
          <input type="number" name="hora" min="0" max="999" value="" placeholder="Horas" class="form-control" value="00"  required >
        @if ($errors->has('hora'))
          <p class="help-block">{{ $errors->first('hora') }}</p>
        @endif
    </div>

    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
      @if ($errors->has('minuto'))
            has-error
      @endif">
      <p>Minutos:</p>
       <input type="number" name="minuto" min="0"
              value=""
              placeholder="Minutos"
              max="999" class="form-control" value="00"   required>
      @if ($errors->has('minuto'))
        <p class="help-block">{{ $errors->first('minuto') }}</p>
      @endif
    </div>
</div>

{{-- Observaciones --}}
<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5">
      <label>Observaciones</label>
      <textarea type="textArea" name="observaciones"  maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
  </div>
</div>

    {{-- Fin Body Panel --}}
    </div>

    {{-- Footer de Panel --}}
    <div class="panel-footer text-right">
        <a  id="cancelar"
            class="btn btn-danger"
            type="reset"><span class="fa fa-times">
          </span> Cancelar</a>

        <button type="submit" name="guardar"  class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
    </div>
</div>

<!-- Fin Nuevo -->

<script>
    $(document).ready(function () {
        $("#fechaInicio").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            showWeek: false,
            numberOfMonths: isSemanaTieneFinMes(),
            firstDay:this.diainicio,
            showButtonPanel: true,
            minDate: this.fechainicio,
            maxDate: this.fechafin,
            selectOtherMonths: true,
            showAnim: 'fadeIn',
            beforeShowDay: false,
        });

        $("#fechaFin").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            showWeek: false,
            numberOfMonths: isSemanaTieneFinMes(),
            firstDay:this.diainicio,
            showButtonPanel: true,
            minDate: this.fechainicio,
            maxDate: this.fechafin,
            selectOtherMonths: true,
            showAnim: 'fadeIn',
            beforeShowDay: false,
        });

        DisableDays(new Date());
    });

    var RangeDates = ["12/8/2017, 13/8/2017"];
    var RangeDatesIsDisable = true;
    function DisableDays(date) {
        var isd = RangeDatesIsDisable;
        var rd = RangeDates;

        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        for (var i = 0; i < rd.length; i++) {
            var ds = rd[i].split(',');

            var di, df;
            var m1, d1, y1, m2, d2, y2;


            if (ds.length == 1) {
                di = ds[0].split('/');

                m1 = parseInt(di[0]);
                d1 = parseInt(di[1]);
                y1 = parseInt(di[2]);
                if (y1 == y && m1 == (m + 1) && d1 == d) return [!isd];
            } else if (ds.length > 1) {
                di = ds[0].split('/');
                df = ds[1].split('/');
                m1 = parseInt(di[0]);
                d1 = parseInt(di[1]);
                y1 = parseInt(di[2]);
                m2 = parseInt(df[0]);
                d2 = parseInt(df[1]);
                y2 = parseInt(df[2]);

                if (y1 >= y || y <= y2) {
                    if ((m + 1) >= m1 && (m + 1) <= m2) {
                        if (m1 == m2) {
                            if (d >= d1 && d <= d2) return [!isd];
                        } else if (m1 == (m + 1)) {
                            if (d >= d1) return [!isd];
                        } else if (m2 == (m + 1)) {
                            if (d <= d2) return [!isd];
                        } else return [!isd];
                    }
                }
            }
        }
        return [isd];
    };

    function isSemanaTieneFinMes() {
        var fechaInicio = $('#fechaInicio').val();
        var fechaFin =    $('#fechaFin').val();

        var arrayFechaInicio = fechaInicio.split('/');
        var arrayFechaFin = fechaFin.split('/');

        var mesInicio = parseInt(arrayFechaInicio[1]);
        var mesFin = parseInt(arrayFechaFin[1]);
        if(mesInicio !== mesFin){
            return 2;
        }else{
            return 1;
        }
    };




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







