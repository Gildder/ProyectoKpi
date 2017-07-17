@extends('layouts.app')

@section('titulo')
	DashBoard
@endsection

@section('content')
<div class="row" id="contentDashboard">
    <section class="content-header" style="min-height: 60px;" >
        <a href="#" @click="abrirWidget" id="btnOpenWidget" class="btn btn-bitbucket btn-xs pull-right" ><span class="fa fa-list-alt"></span>  @{{ textOpenWidget }}</a>
        <h1>Dashboard
            <small>{{ \Cache::get('evadores')->descripcion }}</small>
        </h1>p
    </section>


    <section class="content" id="contenedor-dashboard">
        <div class="row">
          {{-- Inicio Panel Tipo Indicadores Ponderacion --}}
            @include('evaluadores.evaluados.dashboard.partials.ponderacionTipo')
          {{-- Fin Panel Tipo Indicadores --}}
        </div>

        {{-- Contenedor  de Widget --}}
        <div class="">
            {{-- Inicio Panel Tipo Indicadores Ponderacion --}}
            @include('evaluadores.evaluados.dashboard.partials.nuevosWidget')
            {{-- Fin Panel Tipo Indicadores --}}
        </div>

        {{--capa de tipos de indicadores--}}
        <div class="tab-content no-padding">
            <panel-widget :widget="widget" v-for="widget in panelWidgets"></panel-widget>
            {{--<nuevo-modal tipo_id="{{ widget.id }}" titulo="{{ widget.titulo }}"></nuevo-modal>--}}
        </div>
        {{-- Fin de Tipo de Indicadores --}}

    <div>
        <!-- Panel de Escalas-->
        @include('evaluadores.evaluados.dashboard.partials.EscalasEvaluadores')
        {{-- Fin Panel Escalas --}}
    </div>


    </section>
</div>


@endsection

