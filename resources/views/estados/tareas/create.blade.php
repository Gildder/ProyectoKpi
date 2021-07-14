@extends('layouts.app')

@section('titulo')
  @lang('labels.panels.pnsNuevo')
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('estados.tareas.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">@lang('labels.panels.pnsNuevo')</p>
      
  </div>
  <div class="panel-body">

{{-- ColorPicker --}}
<link rel="stylesheet" href="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.css')}}">
<script src="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>

    {!!Form::open(['route'=>'estados.tareas.store', 'method'=>'POST'])!!}

    <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-3">
        <label for="nombre" >@lang('labels.labels.lbsNombre')</label>
        {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingrese el Nombre']) !!}
        @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
    </div>

    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-6">
          <label for="descripcion" >@lang('labels.labels.lbsDescripcion')</label>
          {!! form::textArea('descripcion',null, ['id'=>'descripcion', 'class'=>'form-control', 'placeholder'=>'Ingrese la Descripcion', 'size' => '30x5']) !!}
          @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
    </div>


      {{-- Color --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"><b><i>Estilos</i></b>

              <input type="text" value="{{ old('color') }}" name="color" readonly="true" hidden>
              <input type="text" value="{{ old('texto') }}" name="texto" readonly="true" hidden>
          </div>
          <label>Estilo de Estado:
              <input type="text"
                     id="color"
                     value="Estado"
                     style="background-color: {{ old('color') }}; color:{{ old('texto') }}; "
                     class="input-xs estiloEstado"
                     readonly="true"></label>
          <div class="btn-group" style="width: 100%; margin-bottom: 10px; padding: 10px;">
              <p>Seleccionar los colores de fondo y texto:</p>
              <a class="fa fa-square btn btn-default btn-sn btnSeleccionar" id="color-chooser-btn">  Seleccionar Color Fondo</a>

              <a class="fa fa-square btn btn-default btn-sn btnSeleccionar"  id="texto-chooser-btn">  Seleccionar Color Texto</a>

          </div>
      </div>


      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class=" row col-lg-12 breadcrumb"><b><i>Opciones</i></b></div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <label>
                  <input type="checkbox" name="visibleCalendario" value="1" @if(old('visibleCalendario')) checked @endif >
                  Estado visible en el Calendario
              </label>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <label>
                  <input type="checkbox" name="visibleEmpleado" value="1" @if(old('visibleEmpleado')) checked @endif>
                  Estado visible para el Empleado
              </label>
          </div>
      </div>



  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('estados.tareas.index')}}" class="@lang('labels.stylbtns.btnCancelar')" type="reset"><span class="@lang('labels.icons.icoCancel')"></span> @lang('labels.buttons.btnCancelar')</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->
<style>

    .btnSeleccionar{
        margin: 10px;
    }
</style>

<script>
    $('#color-chooser-btn').colorpicker().on('changeColor', function(e) {
        currColor = e.color.toString('hex');

        //Add color effect to button
        $('#color').css({"background-color": currColor, });
        $('#color-chooser-btn').css({"color": currColor});

        $('input[name="color"]').val(currColor);

    });

    $('#texto-chooser-btn').colorpicker().on('changeColor', function(e) {
        currColor = e.color.toString('hex');

        //Add color effect to button
        $('#color').css({"color": currColor});
        $('#texto-chooser-btn').css({"color": currColor});

        $('input[name="texto"]').val(currColor);

    });

</script>

@endsection
