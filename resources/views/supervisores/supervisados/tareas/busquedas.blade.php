@extends('layouts.app')

@section('titulo')
	Buscar Tareas
@endsection

@section('content')
	<div class="panel panel-default" id="tareArchivadaSupervisortes">
		<div class="panel-heading">
            <a href="{{route('supervisores.supervisados.index')}}" @click="mostrarModalLoading()" class="btn btn-primary btn-xs  pull-left btn-back" title="Volver">
                <span class="fa fa-reply"></span></a>
			<p class="titulo-panel">Busquedas Tareas</p>
		</div>
		<div class="panel-body">
			@include('supervisores/supervisados/tareas/partials/filtro_tareas')
			
            <div class="col-xs12 col-sm-12 col-md-12 col-lg-12  table-responsive">
                @include('supervisores/supervisados/tareas/partials/tabla_busquedas')
            </div>
		
		</div>
		<div class="panel-footer">
		</div>
	</div>
@endsection

