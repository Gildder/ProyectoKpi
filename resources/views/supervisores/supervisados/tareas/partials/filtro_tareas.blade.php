<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    {{--<form @submit.prevent="buscarTarea()">--}}
        {!! Form::open(['route'=>'supervisores.supervisados.tareas.buscar', 'method'=>'POST']) !!}
        <div class="col-xs-12" style="border: 1px solid gray; border-radius: 20px; padding: 10px; border-shadow: 1px 1px 1px gray;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Usuario</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>
            
            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Usuarios</label>
                <select class="form-control" name="cargo_id" >
                    <option value="">Seleccionar</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">
                        {{ $usuario->usuario }} {!! $usuario->activo !!}
                        {!! $usuario->vacacion !!}  {!! $usuario->bloqueado !!}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <label>Apellidos</label>
                <input type="text"  name="apellidos" value="{{ old('apellidos') }}"
                       placeholder="Apellidos" maxlength="40" class="form-control">
            </div>
            
            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Cargos</label>
                <select class="form-control" name="cargo_id" >
                    <option value="">Seleccionar</option>
                    @foreach($cargos as $cargo)
                    <option  value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2">
                <label>Departamentos</label>
                <select class="form-control" name="departamento_id">
                    <option value="" >Seleccionar...</option>
                    @foreach($departamentos as $departamento)
                    <option  value="{{ $departamento->id }}">
                        {{ $departamento->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <label style="color: gray; font-style: italic;">Tareas</label>
                <hr style="margin: 0px; margin-bottom: 10px;">
            </div>
            
            <div class="form-group  col-xs-12 col-sm-2 col-md-2 col-lg-1">
                <label>Nro. </label>
                <input type="number" name="tarea_id" value="{{ old('tarea_id') }}"
                       placeholder="Nro. #" min="1" class="form-control">
            </div>
            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Localizaciones</label>
                <select class="form-control" name="localizacion_id" >
                    <option value="" >Seleccionar</option>
                    @foreach($localizaciones as $localizacion)
                    <option  value="{{ $localizacion->id }}">
                        {{ $localizacion->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="row col-xs-12 col-sm-6 col-md-5 col-lg-4" >
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0px;">
                    <label>Fecha Inicio</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" placeholder="dd/mm/aaaa" value="{{ old('fechaInicio') }}"
                               class="form-control fechas" name="fechaInicio" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin: 0;">
                    <label>Fecha Fin</label>
                    <div class="input-group row" style="margin: 0px;">
                        <input type="text" value="{{ old('fechaFin') }}"
                               placeholder="dd/mm/aaaa" class="form-control fechas" name="fechaFin" >
                        <div class="input-group-addon row">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <label>Estados</label>
                <select class="form-control" name="estado_id" >
                    <option value="" >Seleccionar</option>
                    @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                <hr style="margin: 10px;">
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <button type="submit" style="float: right; margin-left: 10px;"
                        class="btn btn-success btn-sm" >Buscar  <span class="fa  fa-search"></span>
                </button>
                
                <button type="reset" style="float: right;"
                        class="btn btn-danger btn-sm">Limpiar  <span class="fa  fa-times"></span>
                </button>
            </div>
        </div>
    {{--</form>--}}
    {!! Form::close()!!}
</div>

<style>
    .fade-filtro-enter, .fade-filtro-leave {
        opacity: 0;
        transition: all .2s ease;
    }
</style>
