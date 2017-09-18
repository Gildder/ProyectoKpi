{!!Form::open(['action'=>['Evaluadores\EvaluadorController@agregarcargoasignado', $indicador->id, $evaluador->id], 'method'=>'GET'])!!}
            
<div class="modal-body">

<div class="row col-xs-12 col-sm-12">
  <p>Los campos con (*) son obligatorios.</p>
</div>

  <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group @if ($errors->has('cargo_id')) has-error @endif
            col-xs-12 col-sm-6 col-md-6 col-lg-5 row
            ">
        <label for="cargo_id">Cargos *</label>
            <select class="form-control" name="cargo_id"  value="{{ old('cargo_id') }}" required>
                <option value="" >Seleccionar...</option>
                @foreach($cargosEvaluadores as $item)
                  <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
            @if ($errors->has('cargo_id')) <p class="help-block">{{ $errors->first('cargo_id') }}</p> @endif
      </div>
  </div>


  <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="form-group @if ($errors->has('objetivo')) has-error @endif
                  col-xs-12 col-sm-7 col-md-6 col-lg-5 row
                  ">
              <label for="objetivo">Objetivo *</label>
              <input  type="number" max="100" min="1" name="objetivo" value="{{ old('objetivo') }}" placeholder="El valor del objetivo en %" class="form-control" required >
              @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
          </div>
  </div>
        
  <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif
              col-xs-12 col-sm-6 col-md-6 col-lg-5 row
              ">
          <label for="frecuencia_id">Frecuencia *</label>
             
              <select class="form-control" name="frecuencia_id" value="{{ old('frecuencia_id') }}" required>
                  <option value="" >Seleccionar...</option>
                  @foreach($frecuencia as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
              </select>
              @if ($errors->has('frecuencia_id')) <p class="help-block">{{ $errors->first('frecuencia_id') }}</p> @endif
        </div>
    </div>


    <div class="row col-xs-12 col-sm-10 col-md-8 col-lg-8">
        <div class="form-group @if ($errors->has('condicion')) has-error @endif">
            <label for="condicion">Condicion </label>
            <textarea type="textArea" name="condicion" maxlength="120" value="{{ old('condicion') }}" placeholder="Ingresar la condicion" class="form-control" rows="3" cols="9"></textarea>

            @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
        </div>
    </div>

  <div class="row col-xs-12 col-sm-10 col-md-8 col-lg-8">
          <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif">
            <label for="aclaraciones">Aclaraciones </label>
            <textarea type="textArea" name="aclaraciones" maxlength="120" value="{{ old('aclaraciones') }}" placeholder="Coloca algunas aclaraciones" class="form-control" rows="3" cols="9"></textarea>
              @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
          </div>
  </div>        

</div>
 <div class="modal-footer col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 5px;" >
     <div style="border-top: 2px solid white; padding-top: 10px;">
         <a id="btncancelarnuevoindicador" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
         <button type="submit"   class="btn btn-success guardar"><span class="fa fa-save"></span> Guardar</button>
     </div>

  </div>
  {!! Form::close()!!}


