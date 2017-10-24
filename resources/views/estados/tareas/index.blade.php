@extends('layouts.app')


@section('titulo')
  Cargos
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Cargos</p>

  </div>
  <div class="panel-body">

    @include('partials/alert/error')

    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('empleados.cargo.create')}}" class="btn btn-primary btn-sm" title="Nuevo"><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >

        <a  href="{{route('empleados.cargo.eliminados')}}" class="btn btn-danger btn-sm"  title="Eliminados"><span class="fa  fa-trash"></span>  <b></b></a>
      </div>
    </div>
    {{-- Fin Opciones Menu --}}
    <div class="row">
      <div class="col-lg-12">
        @include('empleados/cargo/partials/tabla_cargo')
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection
