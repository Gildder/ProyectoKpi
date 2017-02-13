
<!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nuevo">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
    {{-- Header de modal --}}
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Nueva Tarea Programada</b>
      </div>

      {{-- Body del modal --}}
      <div class="modal-body modal-delete-body">
        {!!Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST'])!!}

        {{-- Modal body --}}
        <div class="modal-body col-sm-12">

{{-- Descripcion --}}
<div class="col-sm-12">
  <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-10">
    <label class="row">Descripcion *</label>
    <input  type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" required>
    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
  </div>
</div>

{{-- Tiempo estimado --}}
<div class="col-sm-12">
 <div class="form-group">
    <label>Tiempo Estimado *</label>
    <div class="row col-sm-12">
      <div class="col-xs-6 col-sm-4 col-md-5 @if ($errors->has('hora')) has-error @endif">
        Horas:<input type="text" name="hora" class="form-control" value="00"  required >
        @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

      </div> 
      <div class="col-xs-6 col-sm-4 col-md-5 @if ($errors->has('minuto')) has-error @endif">
        Minutos: <input type="text" name="minuto" class="form-control" value="00"   required>
        @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif

      </div>
    </div>
</div>
</div> 


<div class="col-sm-12">
  <hr>
  <label class=" row col-sm-12">Semana Programada *</label>
  <small>Selecciona la semana que deseas programas tu tarea.</small><br><br>
  {{-- Fecha de Inicio --}}
  <div class="form-group col-sm-12">
      Selecciona:
      <select name="selecion_semana" id="selecion_semana">
          @foreach($semanas as $item)
                <option value="{{$item['semana']}}">Semana {{$item['semana']}} del Mes de {{nombreMes($item['mes'])}}</option> 
          @endforeach
      </select>
  </div>
  <div class="row form-group  col-sm-12">
    <div class="col-sm-4">Fecha Inicio: <label id="fechaInicio" name="fechaInicioEstimado"></label></div>
    <div class="col-sm-4">Fecha Fin: <label id="fechaFin" name="fechaFinEstimado"></label></div>
  </div>
</div>
        {{-- Fin body  model --}}
        </div>
        <div class="modal-footer modal-delete-footer">
          <a data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
          <a id="registrar" class="btn btn-success" ><span class="fa fa-check"></span> Aceptar</a>
          {{-- {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!} --}}
        </div>
        {!! Form::close()!!}
      </div>
      </div>

    </div>
    {{-- fin ontenido  --}}
</div>



<?php
  function nombreMes($nro)
  {
    $mes = 'mes';
    switch($nro)
    {

      case '1':
        $mes = 'Enero';
        break;
      case '2':
        $mes = 'Febrero';
        break;
      case '3':
        $mes = 'Marzo';
        break;
      case '4':
        $mes = 'Abril';
        break;
      case '5':
        $mes = 'Mayo';
        break;
      case '6':
        $mes = 'Junio';
        break;
      case '7':
        $mes = 'Julio';
        break;
      case '8':
        $mes = 'Agosto';
        break;
      case '9':
        $mes = 'Septiembre';
        break;
      case '10':
        $mes = 'Octubre';
        break;
      case '11':
        $mes = 'Noviembre';
        break;
      case '12':
        $mes = 'Diciembre';
        break;

    }
    return $mes;
  }
?>


<script>
  $(document).ready(function(){
      cargarFechas();

      $('#registrar').

      $('#selecion_semana').change(function() {
          cargarFechas();
      });

      function cargarFechas()
      {
        var result = $('#selecion_semana option:selected').attr('value');
          @foreach ($semanas as $item) 
            if({{$item['semana']}} == result)
            {
              $('#fechaInicio').html('{{$item['fechaInicio']}}');
              $('#fechaFin').html('{{$item['fechaFin']}}');
            }
          @endforeach
      }

      function refresCampos()
      {
        $("input[name='descripcion']").val("");
        $("input[name='hora']").val("00");
        $("input[name='minuto']").val("00");

        alert('semana');
      }
   
    
  });
</script>

