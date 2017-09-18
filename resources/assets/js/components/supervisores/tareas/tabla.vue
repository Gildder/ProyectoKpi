<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover myDataTables">
            <thead>
            <tr>
                <th>Nro</th>
                <th>Usuario</th>
                <th>Tareas</th>
                <th>Fechas Inicio Estimadas</th>
                <th>Fechas Fin Estimadas</th>
                <th>Tiempo estimados</th>
                <th>Fechas Inicio Ejecucion</th>
                <th>Fechas Fin Ejecucion</th>
                <th>Tiempo Ejecucion</th>
                <th>Estado</th>
                <th>Observaciones</th>
                <th>Ubicaciones</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @if(isset($tareas))
            @foreach($tareas as $tarea)
            <tr>
                <td><b class="btn btn-warning btn-xs" title="Ver Empleado" data-toggle="modal" data-target="#modal-usuarioTarea-{{$tarea->user_id}}" > {{ $tarea->user_id }}</b></td>
                <td>
                    <label  style="background: {{$tarea->color}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{ $tarea->usuario }} </label>
                </td>
                <td> {{ $tarea->descripcion }}</td>
                <td>{{ $tarea->fechaInicioEstimado }}</td>
                <td>{{ $tarea->fechaFinEstimado }}</td>
                <td>{{ $tarea->tiempoEstimado }}</td>
                <td>{{ $tarea->fechaInicioEjecucion }}</td>
                <td>{{ $tarea->fechaFinEjecucion }}</td>
                <td>{{ $tarea->tiempoSolucion }}</td>
                <td>
                    <label  style="background: {{$tarea->estados->color}}; color:{{$tarea->estados->texto}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{$tarea->estados->nombre}} </label>
                </td>
                <td>{{$tarea->getObservacion() }}</td>
                <td>
                    <ul style="padding: 10px;">
                        @foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
                        <li>{{ $ubicacion->nombre }} </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="#" class="btn btn-google btn-xs" title="Agregar Error"> <span class=" fa fa-legal"></span></a>
                    <a class="btn btn-dropbox btn-xs"
                       href="javascript:void(0)"  data-toggle="modal" data-target="#modal-tareaDetalle-{{$tarea->tarea_id}}" title="Ver Tarea"> <span class=" fa fa-eye"></span></a>
                </td>
            </tr>
            <div class="col-xs-12">
                @include('supervisores/supervisados/tareas/partials/tarea')
                @include('supervisores/supervisados/tareas/partials/empleado')
            </div>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</template>

<script>


    export default {
        props: [ // 0: listado, 1:archivas, 2:eliminadas
            'modelo'
        ],
        data: function(){
            return {
//                //Tarea
//                btnEliminar: 1,
            }
        },
        ready: function () {
            this.opcionModeloTarea(this.modelo);
        },
        methods: {
            opcionModeloTarea: function(opcion) {
                if(opcion == 0){
                    this.$parent.btnResultado = 1;
                    this.$parent.btnEditar = 1;
                    this.obtenerEstadoBtnEliminarTarea();
                }else{
                    this.$parent.btnResultado = 0;
                    this.$parent.btnEditar = 0;
                    this.$parent.btnEliminar = 0;
                }
            },
            obtenerEstadoBtnEliminarTarea: function () {
                // verificar si se puede eliminar una tarea
                $.ajax({
                    url: window.location.pathname+'/obtenerEstadoBtnEliminarTarea',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.$parent.btnEliminar = data;

                    }.bind(this), error: function (data) {
                        console.log('Error: Al intentar obtener opcion de boton elimnar.');
                    }.bind(this)
                })
            },
        }

    }
</script>
