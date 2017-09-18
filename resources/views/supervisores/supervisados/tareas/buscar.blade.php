@extends('layouts.app')

@section('titulo')
	Buscar Tareas
@endsection

@section('content')
	<div class="panel panel-default" id="tareArchivadaSupervisortes">
		<div class="panel-heading">
            <a href="{{route('supervisores.supervisados.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver">
                <span class="fa fa-reply"></span></a>
			<p class="titulo-panel">Tareas Archivadas</p>
		</div>
		<div class="panel-body">
			<div id="datos" class="tab-pane fade in active">
				@include('partials/alert/error')
                {{--<div v-show="mostrar_bar_botones" class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12" >--}}
                    {{--<a href="#" style="float: right" class="btn btn-instagram btn-sm" title="Tareas Archivadas">Buscar <span class="fa fa-search"></span></a>--}}
                {{--</div>--}}

				{{--<div class="row" v-show="mostrar_panel_filtros">--}}
                    {{--@include('supervisores.supervisados.tareas.partials.buscar_atributos')--}}
				{{--</div>--}}

                <tarea-filtro-supervisores
                        :supervisorid = "{{ \Usuario::get('id') }}"
                        :cargos="{{ $cargos }}"
                        :departamentos="{{ $departamentos }}"
                        :estados="{{ $estados }}"
                        :ubicaciones="{{ $ubicaciones }}"
                        :usuarios="{{ $usuarios }}"
                ></tarea-filtro-supervisores>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                    <hr style="margin: 0px; margin-bottom: 10px;">
                </div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        	@include("supervisores/supervisados/tareas/partials/tabla_tareas")
					</div>
				</div>
			</div>
		</div>

		<div class="panel-footer">
		</div>
	</div>
@endsection

