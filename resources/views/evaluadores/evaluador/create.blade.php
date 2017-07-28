@extends('layouts.app')

@section('titulo')
  Nuevo Evaluador
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('evaluadores.evaluador.index')}}" @click="mostrarModalLoading()"  class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Gerencia Evaluadora</p>
  </div>
  <div class="panel-body">

      {!!Form::open(['route'=>'evaluadores.evaluador.store', 'method'=>'POST', 'id'=> 'formEvaluador'])!!}
      <div class="col-md-12 breadcrumb">
        <p>Los campos con (*) son obligatorios.</p>
      </div>
  
      <div class="row">
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-xs-12 col-sm-6 col-md-5 col-lg-4">
            <label for="descripcion" >Nombre *</label>
    <input  type="text"  maxlength="40" name="descripcion"  value="{{ old('descripcion') }}" placeholder="Ingresa el nombre" class="form-control" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
      </div>

      <div class="row ">
        <div class="form-group @if ($errors->has('abreviatura')) has-error @endif col-xs-12 col-sm-3 col-md-2 col-lg-2">
            <label for="abreviatura" >Abreviatura *</label>
            <input  type="text"  maxlength="10" name="abreviatura"  value="{{ old('abreviatura') }}"
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                    placeholder="eg: GADM" class="form-control" required>
            @if ($errors->has('abreviatura')) <p class="help-block">{{ $errors->first('abreviatura') }}</p> @endif
        </div>

      </div>
      <div class="row ">
        <div class="form-group @if ($errors->has('ponderacion_id')) has-error @endif  col-xs-12 col-sm-5 col-md-4 col-lg-3">
            <label for="ponderacion_id" >Selecciona Ponderacion *</label>
            <select class="form-control" name="ponderacion_id" value="{{ old('ponderacion_id') }}">
                <option value="" >Seleccionar...</option>
                @foreach($ponderaciones as $items)
                  <option value="{{$items->id}}">{{$items->nombre}}</option>
                @endforeach
            </select>
            @if ($errors->has('ponderacion_id')) <p class="help-block">{{ $errors->first('ponderacion_id') }}</p> @endif
        </div>
      </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('evaluadores.evaluador.index')}}" @click="mostrarModalLoading()"  class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <button type="submit" @click="mostrarModalLoading()" disabled="true"  class="btn btn-success guardar" type="reset"><span class="fa fa-save"></span> Guardar</button>
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->
<script>
    $(document).ready(function() {

        $("#formEvaluador  input,select").change(function () {
            let form = $(this).parents("#formEvaluador");
            let check = checkCampos(form);
            if (check) {
                $(".guardar").prop("disabled", false);
            }
            else {
                $(".guardar").prop("disabled", true);
            }
        });

        //Función para comprobar los campos de texto
        function checkCampos(obj) {
            var camposRellenados = false;
            cantidad = 0;
            obj.find("input").each(function () {
                let $this = $(this);
                if ($this.val().length > 0) {
                    cantidad ++;
                    console.log($this.val().length);

                    camposRellenados = true;
                    return true;
                }else {
                    if(cantidad >0)
                        cantidad--;
                }
            });
            if (camposRellenados && cantidad === 3) {
                return true;
            }
            else {
                return false;
            }
        }

    });
</script>
@endsection