{!!Form::open(['action'=>['_TablaMes', $indicador->id, $evaluador->id], 'method'=>'GET'])!!}
            
<div class="modal-body">

<div class="col-sm-12">
  <p>Los campos con (*) son obligatorios.</p>
</div>

<div class="row col-sm-12">
  <div class="row col-sm-3">
    <div class="form-group @if ($errors->has('cargo_id')) has-error @endif  col-sm-12">
        <label for="cargo_id">Cargos *</label>
            <select class="form-control" name="cargo_id" required>
                <option value="" >Seleccionar...</option>
                @foreach($cargosEvaluadores as $item)
                  <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
            @if ($errors->has('cargo_id')) <p class="help-block">{{ $errors->first('cargo_id') }}</p> @endif
      </div>
  </div>
</div>


<div class="row col-sm-12">
  <div class="row col-sm-3">
          <div class="form-group @if ($errors->has('objetivo')) has-error @endif  col-sm-12">
              <label for="objetivo">Objetivo *</label>
              <input  type="number" max="100" min="1" name="objetivo" placeholder="El valor del objetivo en %" class="form-control" required> 
              @if ($errors->has('objetivo')) <p class="help-block">{{ $errors->first('objetivo') }}</p> @endif
          </div>
  </div>
        
  <div class="row col-sm-3">
      <div class="form-group @if ($errors->has('frecuencia_id')) has-error @endif  col-sm-12">
          <label for="frecuencia_id">Frecuencia *</label>
             
              <select class="form-control" name="frecuencia_id" required>
                  <option value="" >Seleccionar...</option>
                  @foreach($frecuencia as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
              </select>
              @if ($errors->has('frecuencia_id')) <p class="help-block">{{ $errors->first('frecuencia_id') }}</p> @endif
        </div>
    </div>
</div>

<div class="row col-sm-12">
    
  <div class="row col-sm-6">
          <div class="form-group @if ($errors->has('condicion')) has-error @endif  col-sm-12">
            <label for="condicion">Condicion </label>
            <textarea type="textArea" name="condicion" maxlength="120" placeholder="Ingresar la condicion" class="form-control" rows="3" cols="9"></textarea>

              @if ($errors->has('condicion')) <p class="help-block">{{ $errors->first('condicion') }}</p> @endif
          </div>
  </div>
</div>

<div class="row col-sm-12">
  <div class="row col-sm-6">
          <div class="form-group @if ($errors->has('aclaraciones')) has-error @endif  col-sm-12">
            <label for="aclaraciones">Aclaraciones </label>
            <textarea type="textArea" name="aclaraciones" maxlength="120" placeholder="Coloca algunas aclaraciones" class="form-control" rows="3" cols="9"></textarea>
              @if ($errors->has('aclaraciones')) <p class="help-block">{{ $errors->first('aclaraciones') }}</p> @endif
          </div>
  </div>        
</div>


 <div class="modal-footer modal-delete-footer">
 <hr>
    <a id="btncancelarnuevoindicador" class="btn btn-danger btn-sm " ><span class="fa fa-times"></span> Cancelar</a>

    {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success btn-sm', 'type'=>'submit'  ]) !!}
  </div>
  {!! Form::close()!!}
</div>