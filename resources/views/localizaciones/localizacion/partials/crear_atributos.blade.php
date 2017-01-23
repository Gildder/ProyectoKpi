<div class="form-group col-xs-12 col-sm-10 col-md-8">

	<div class="row">
		<div class="form-group @if ($errors->has('nombre')) has-error @endif col-sm-5 ">
              <label for="nombre" class="hidden-xs">Nombre</label>
              {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
              @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>
        
		<div class="form-group @if ($errors->has('grupoloc_id')) has-error @endif  col-sm-5 ">
          <label for="grupoloc_id" class="hidden-xs">Grupo Localizacion</label>
            <select class="form-control" name="grupoloc_id">
                  <option value="" >Seleccionar...</option>
                @foreach($grupo as $item)
                  <option value="{{$item->idgrupo}}">{{$item->nombregrupo}}</option>
                @endforeach
            </select>
            @if ($errors->has('grupoloc_id')) <p class="help-block">{{ $errors->first('grupoloc_id') }}</p> @endif

        </div>
	</div>

	<div class="row">
	  	<div class="form-group  @if ($errors->has('direccion')) has-error @endif  col-xs-12 col-sm-6 col-md-5">
			<label for="direccion">Direccion </label>
	      {!! form::text('direccion',null, ['id'=>'direccion', 'class'=>'form-control', 'placeholder'=>'Ingresa la Direccion', 'maxlength'=>'30', 'type'=>'text']) !!}
	       @if ($errors->has('direccion')) <p class="help-block">{{ $errors->first('direccion') }}</p> @endif
		</div>

		<div class="form-group  @if ($errors->has('telefono')) has-error @endif   col-xs-12 col-sm-6 col-md-5">
			<label for="telefono">Telefono </label>
	      	{!! form::text('telefono',null, ['id'=>'telefono', 'class'=>'form-control', 'placeholder'=>'Ingresa el Telefono', 'maxlength'=>'20', 'type'=>'phono']) !!}
			@if ($errors->has('telefono')) <p class="help-block">{{ $errors->first('telefono') }}</p> @endif
		</div>
	</div>
</div>