<div class="col-sm-12">
  <p>Los campos con (*) son obligatorios.</p>
</div>
  
<div class="row col-sm-12">
  <div class="form-group @if ($errors->has('cargo_id')) has-error @endif  col-sm-6">
      <label for="cargo_id" class="hidden-xs">Cargo *</label>
         
          <select class="form-control" name="cargo_id">
              <option value="" >Seleccionar...</option>
              @foreach($cargosEvaluadores as $cargo)
                 @if($cargo->id == $indicadorcargo->cargo_id)
                       <option value="{{$cargo->id}}" selected="selected" >{{$cargo->nombre}}</option>
                 @else
                       <option value="{{$cargo->id}}" >{{$cargo->nombre}}</option>
                 @endif
              @endforeach
          </select>
          @if ($errors->has('cargo_id')) <p class="help-block">{{ $errors->first('cargo_id') }}</p> @endif
    </div>
</div>


<div class="row col-sm-12">
    <div class="form-group @if ($errors->has('objetivo')) has-error @endif  col-sm-6">
    <label for="objetivo" class="hidden-xs">Objetivo *</label>
        <input  type="number" max="100" min="1" name="objetivo" value="{{ $indicadorcargo->objetivo }}"  placeholder="El valor del objetivo en %" class="form-control" required> 
        @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
    </div>
</div>
  
<div class="row col-sm-12">
  <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif  col-sm-6">
      <label for="frecuencia_id" class="hidden-xs">Frecuencia *</label>
          <select class="form-control" name="frecuencia_id">
              <option value="" >Seleccionar...</option>
              @foreach($frecuencia as $frecuencia)
                 @if($frecuencia->id == $indicadorcargo->frecuencia_id)
                       <option value="{{$frecuencia->id}}" selected="selected" >{{$frecuencia->nombre}}</option>
                 @else
                       <option value="{{$frecuencia->id}}" >{{$frecuencia->nombre}}</option>
                 @endif
              @endforeachs
          </select>
          @if ($errors->has('frecuencia_id')) <p class="help-block">{{ $errors->first('frecuencia_id') }}</p> @endif
    </div>
</div>

<div class="row col-sm-12">
  <div class="form-group @if ($errors->has('condicion')) has-error @endif  col-sm-10">
      <label for="condicion" class="hidden-xs">Condicion</label>
      <textarea type="textArea" name="condicion" maxlength="120" placeholder="Ingresar una condicion" class="form-control" rows="3" cols="9">{{ $item->condicion }}</textarea>
      @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
  </div>
</div>

<div class="row col-sm-12">
  <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif  col-sm-10">
      <label for="aclaraciones" class="hidden-xs">Aclaraciones</label>
      <textarea type="textArea" name="aclaraciones" maxlength="120" placeholder="Ingresa una aclaracion" class="form-control" rows="3" cols="9">{{ $item->aclaraciones }}</textarea>
      @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
  </div>
</div>        

