@extends('layouts.app')

@section('titulo')
  @lang('labels.titlesPage.ttlConexionLdap')
@endsection

@section('content')

<div class="panel panel-default" >
  <div class="panel-heading">
    <p class="titulo-panel">@lang('labels.panels.pnsConexionLdap')</p>
  </div>

  <div class="panel-body">
    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div id="submenu" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
        <a  href="{{url('configuraciones/ldap/create')}}"
            class="@lang('labels.stylbtns.btnNuevo')" ><span class="@lang('labels.icons.icoBtnNuevo')">  </span>
            <b>@lang('labels.buttons.btnNuevo')</b>
        </a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      {{--tabla de coneciones --}}
      @include('configuraciones/ldap/partials/tabla_conexion')
    </div>
  </div>
  <div class="panel-footer">
  </div>
</div>


@endsection

