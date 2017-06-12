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
        </h1>
    </section>


    <section class="content" id="contenedor-dashboard">
        <div class="row">
          {{-- Inicio Panel Tipo Indicadores Ponderacion --}}
            @include('evaluadores.evaluados.dashboard.partials.ponderacionTipo')
          {{-- Fin Panel Tipo Indicadores --}}
        </div>

        {{-- Contenedor  de Widget --}}
        <div class="row">
            {{-- Inicio Panel Tipo Indicadores Ponderacion --}}
            @include('evaluadores.evaluados.dashboard.partials.nuevosWidget')
            {{-- Fin Panel Tipo Indicadores --}}
        </div>

        {{--capa de tipos de indicadores--}}
        <div class="tab-content no-padding">
            @foreach($tipos as $tipo)
            @if($tipo->id == 1) {{-- Solamente cargamos los de tipo procesos --}}
                @include('evaluadores/evaluados/dashboard/partials/total_tipoIndicadores')
                @endif
            @endforeach
        </div>
        {{-- Fin de Tipo de Indicadores --}}

    <div >
        <!-- Panel de Escalas-->
        @include('evaluadores.evaluados.dashboard.partials.EscalasEvaluadores')
        {{-- Fin Panel Escalas --}}
    </div>

    </section>
</div>
<script src="{{URL::asset('dist/js/app-vuejs.js')}}"></script>
@endsection
