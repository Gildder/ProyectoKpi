<div class="row" id="capa-indicadores-{{ $tipo->id }}">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{ $tipo->nombre }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i></button>
                        {{--Cambie este codigo --}}
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Opciones</a></li>
                            <li><a href="#">Graficas</a></li>
                            <li class="divider"></li>
                            <li><a href="#" @click.prevent="cambiarVista(0)">Vista Semanas</a></li>
                            <li><a href="#" @click.prevent="cambiarVista(1)">Vista Meses</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="">
                    {{-- Filtro de Los totales  --}}
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
                        {{-- Botones de Filtro --}}
                        <a  href="#" class="btn btn-danger btn-sm" title="Exportar PDF"><span class="fa  fa-file-pdf-o"> Pdf </span> </a>
                        <a  href="#" @click.prevent="siguienteMes" class="btn btn-success btn-sm" title="Exportar XLS"><span class="fa fa-file-excel-o"> Excel </span> </a>
                        <a  href="#" @click.prevent="anteriorMes" class="btn btn-bitbucket btn-sm" title="Filtros"><span class="fa fa-filter">  Filtro</span> </a>
                    </div>
                    {{-- Fin de Filtro Totales --}}

                    {{--Tabla y Grafico del indicador --}}
                    <div class="col-md-8">
                        <div class="table">
                            {{-- Filtro guiente Mes --}}
                            <div class="pull-right" data-toggle="buttons-checkbox" v-if="isSemanal">
                                <label style="border-right: 20px;">Seleccionar Mes:</label>
                                <div class="btn-group">
                                    <a class="btn btn-default btn-sm left" title="Anterior" @click.prevent="anteriorMes" :disabled="bloquearAnteriorMes">&lsaquo;</a>
                                    <a class="btn btn-default btn-sm "><b>@{{ obtenerNombreMes(filtroVista.mesBuscado) }}</b></a>
                                    <a class="btn btn-default btn-sm  right" title="Siguiente" @click.prevent="siguienteMes" :disabled="bloquearSiguienteMes">&rsaquo;</a>
                                </div>
                            </div>
                            @include('evaluadores.evaluados.dashboard.partials.procesos.tablas.tablaTotal')
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>{{ \Calcana::getNombreMes(\FiltroTabla::getMesBuscado())  }}</strong>
                        </p>
                        <div class="chart">
                                <div id="chart_Total"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

