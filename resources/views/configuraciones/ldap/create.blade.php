@extends('layouts.app')

@section('titulo')
    @lang('labels.titlesPage.ttlNuevaLdap')
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('configuraciones.ldap.index')}}" @click="mostrarModalLoading()"  class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Gerencia Evaluadora</p>
  </div>
  <div class="panel-body">
  </div>
</div>

@endsection
