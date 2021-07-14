<div class="panel panel-primary">
    <div class="panel-heading">
        <b>Aprobador de Opciones</b>
    </div>
    <div class="panel-body" style="padding: 20px;">

    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <form @submit="guardarUsuarioAprobador($event)">
                <input type="text" v-model="evaluadorAprobador_id" value="{!! $evaluador->id !!}" name="evaluador_id" hidden>
                <div class="form-group @if ($errors->has('opcion_id')) has-error @endif col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="opcion_id">
                            Selecionar Aprobacion:
                        </label>
                    </div>
                    <div class="row col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <select name="opcion_id" id="opcionAprobador_id" class="form-control" v-model="opcionAprobador_id">
                        <option value="">Seleccionar</option>
                        @foreach($opcionesDisponibles as $opcion_dis)
                            <option value="{!! $opcion_dis->id !!}">
                                {!! $opcion_dis->descripcion !!}
                            </option>
                        @endforeach
                    </select>
                    </div>
                    @if ($errors->has('opcion_id')) <p class="help-block">{{ $errors->first('opcion_id') }}</p> @endif
                </div>

                <div class="form-group @if ($errors->has('user_id')) has-error @endif col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="user_id">
                            Aprobador:
                        </label>
                    </div>
                    <div class="row col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <p>@{{ usuarioAprobador }} <a href="#" v-show="usuarioAprobador != '' "  @click="quitarUsuarioAprobador($event)" class="btn btn-danger btn-xs" title="Eliminar"><i class="fa fa-trash"></i></a></p>
                        <input type="text" style="display: none" class="form-control" name="user_id" hidden>
                        @if ($errors->has('user_id')) <p class="help-block">{{ $errors->first('user_id') }}</p> @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <hr>
                    <button class="@lang('labels.stylbtns.btnGuardar') btn-sm" style="float: right" >
                        <i class="@lang('labels.icons.icoSave')"></i>    @lang('labels.buttons.btnGuardar')
                    </button>
                </div>
            </form>
        </div>

        <div class="row col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <form @submit="buscarUsuariosAprobador($event)">
                <input type="text" hidden value="{{ $evaluador->id }}" name="evaluador_id">
                <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="row  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="nombres">
                            Nombre:
                        </label>
                    </div>
                    <div class="row  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="text" v-model="nombreAprobador"  class="form-control" maxlength="20" name="nombre">
                    </div>
                </div>
                <div class="form-group  col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="row  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label for="apellido">
                        Apellido:
                    </label>
                    </div>
                    <div class="row  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="text" v-model="apellidoAprobador"  class="form-control" name="apellido" maxlength="20">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button type="reset" class="@lang('labels.stylbtns.btnLimpiar') btn-xs" @click="limpiarUsuarioBuscados($event)">
                            <i class="@lang('labels.icons.icoCancel')"></i>
                            @lang('labels.buttons.btnLimpiar')
                        </button>

                        <button class="@lang('labels.stylbtns.btnBuscar') btn-xs"
                                type="submit">
                            <i class="@lang('labels.icons.icoBtnBuscar')"></i>
                            @lang('labels.buttons.btnBuscar')
                        </button>
                    </div>
                </div>
            </form>
            <div class="row col-xs-12">
                <hr>
            </div>
            <div class="col-xs-12 table-responsive">
                <table  class="table table-striped table-bordered table-condensed table-hover ">
                    <thead>
                        <th>
                            Nombre Completo
                        </th>
                        <th>
                            Correo
                        </th>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuariosPosibleAprobador">
                            <td>
                                <a href="#" id="@{{ usuario.id }}" class="btn btn-link selecionarUsuario" @click="cargarUsuarioAprovador($event, usuario)">
                                    @{{ usuario.nombres }} @{{ usuario.apellidos }}
                                </a>
                                <input type="text" hidden value="@{{ usuario.id }}">
                            </td>
                            <td>
                                @{{ usuario.correo }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="panel-footer">
        <a href="#" class="@lang('labels.stylbtns.btnCancelar') btn-sm" @click="ocultarNuevaAprobacion($event)">
            <i class="@lang('labels.icons.icoCancel')"></i>    @lang('labels.buttons.btnCancelar')
        </a>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#mytablausuario').DataTable();
    })

    $('.selecionarUsuario').click(function () {
        console.log($(this).html());
        $('input[name="user_id"]').val($(this).attr('id'));
        $('#user_id').html($(this).html());
    });

    function cargarUsuario() {
        console.log($(this).html());

        $('input[name="user_id"]').val($(this).attr('id'));
        $('#user_id').html($(this).html());
    }
</script>
