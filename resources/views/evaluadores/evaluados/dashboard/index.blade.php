@extends('layouts.app')

@section('titulo')
	DashBoard
@endsection

@section('content')


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">{!! \Cache::get('evadores')->abreviatura !!} - {!! \Cache::get('evadores')->descripcion !!}</p>
  </div>
  <div class="panel-body">
      {{-- Inicio Panel Tipo Indicadores Ponderacion --}}
        @include('evaluadores.evaluados.dashboard.partials.ponderacionTipo')
      {{-- Fin Panel Tipo Indicadores --}}

    {{-- Panel de Tipo de Indicadores --}}
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tipo de Indicadores</h3>

          <!-- Tabs within a box -->
          <ul class="nav nav-tabs pull-right" id="myTab" >
            @foreach($tipos as $tipo)
              @if($tipo->id == '1')
                <li class=" tipos-{!! $tipo->id !!} active"  ><a href="#tipoPanel-{!! $tipo->id !!}" style="font-weight: bold;" data-toggle="tab"><i id="ico" class="fa "></i> <strong>{!! $tipo->nombre !!}</strong>  </a></li>
              @else
                {{-- <li class="tipos-{!! $item->id !!}"><a href="#tipoPanel-{!! $item->id !!}" data-toggle="tab"  style="font-weight: bold;"><i id="ico" class="fa "></i>   {!! $item->nombre !!}</a></li> --}}
              @endif
            @endforeach
          </ul>
        </div>

        <!-- Tabla de Totales de Tipos Indicadores -->
        <div class="box-body">
          <div class="tab-content no-padding">
              @foreach($tipos as $tipo)
                @if($tipo->id == '1')
                   @include('evaluadores/evaluados/dashboard/partials/procesos/tabla_tipoProcesos')
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
      {{-- Fin Panel Tipo Indicadores --}}

      <!-- Panel de Escalas-->
      @include('evaluadores.evaluados.dashboard.partials.EscalasEvaluadores')
      {{-- Fin Panel Escalas --}}

    </div>

  <div class="panel-footer">
  </div>
</div>


<script>
  $(document).ready(function(){
      $(".tipo-1").addClass("bg-aqua");
      $(".tipo-2").addClass("bg-green");
      $(".tipo-3").addClass("bg-yellow");
      $(".tipo-4").addClass("bg-red");

      $(".tipo-1 * #ico").addClass("fa-gear");
      $(".tipo-2 * #ico").addClass("fa-leaf");
      $(".tipo-3 * #ico").addClass("fa-bank");
      $(".tipo-4 * #ico").addClass("fa-child");


      $(".tipos-1 * #ico").addClass("fa-gear");
      $(".tipos-2 * #ico").addClass("fa-leaf");
      $(".tipos-3 * #ico").addClass("fa-bank");
      $(".tipos-4 * #ico").addClass("fa-child");

     $(".completo").toggle(function() {
          $('#text-1').text("Menos Información").siblings(".complete").show();
      }, function() {
          $('#text-1').text("Más Información").siblings(".complete").hide();
      });

  });
</script>


@endsection
