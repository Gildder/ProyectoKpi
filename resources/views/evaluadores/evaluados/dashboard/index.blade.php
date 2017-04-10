@extends('layouts.app')

@section('titulo')
	DashBoard
@endsection

@section('content')

<script type="text/javascript">
$(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">{!! $evaluador->abreviatura  !!} - {!! $evaluador->descripcion !!}</p>
  </div>
  <div class="panel-body">
      <!-- Ponracion de Tipos de Indicadores-->
        @foreach($tipos as $item)
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="tipo-{{ $item->id}} small-box">
            <div class="inner">
              <h3>{{ $item->ponderacion}}<sup style="font-size: 20px">%</sup></h3>

              <p>{{ $item->nombre}}</p>
            </div>
            <div class="icon">
              <i id="ico" class="fa "></i>
            </div>
          {{--   <div class="completo">
              <p>Esta es una inforamcion de prueba</p>
            </div> --}}
            <a href="#" class="text-{{ $item->id }}  small-box-footer">{{-- Mas Informacion <i class="fa fa-arrow-circle-right"></i> --}}</a>
          </div>
        </div>
        @endforeach

        {{-- Panel de Tipo de Indicadores --}}
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tipo de Indicadores </h3>

              <!-- Tabs within a box -->
              <ul class="nav nav-tabs pull-right" id="myTab" >
                @foreach($tipos as $item)
                  @if($item->id == '1')
                    <li class=" tipos-{!! $item->id !!} active"  ><a href="#tipoPanel-{!! $item->id !!}" style="font-weight: bold;" data-toggle="tab"><i id="ico" class="fa "></i> <strong>{!! $item->nombre !!}</strong>  </a></li>
                  @else
                    <li class="tipos-{!! $item->id !!}"><a href="#tipoPanel-{!! $item->id !!}" data-toggle="tab"  style="font-weight: bold;"><i id="ico" class="fa "></i>   {!! $item->nombre !!}</a></li>
                  @endif
                @endforeach
              </ul>
            </div>

            <!-- Tabla de Totales de Tipos Indicadores -->
            <div class="box-body">
              <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                  @foreach($tipos as $item)
                    @if($item->id == '1')
                      <div class="chart tab-pane active" id="tipoPanel-{!! $item->id !!}" style="position: relative; height: 300px;">
                        <div class="panel-filtros">
                          
                        </div>
                        <div class="panel-tabla">
                          @include('evaluadores/evaluados/dashboard/partials/procesos/tabla_tipoProcesos')
                        </div>
                      </div>
                    @else
                      <div class="chart  tab-pane" id="tipoPanel-{!! $item->id !!}" style="position: relative; height: 300px;">
                        <h1>{!! $item->id !!}</h1>
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
              <!-- /.row -->
          </div>



            <!-- Escalas-->
            <div class="box-footer">
              <div class="row">
              <div class="col-sm-12" style="text-align: center; padding: 10px; background: #e7e6e8;  box-shadow: 1px 1px 0 0 #909090; border-right: 0.3em;"><b>Escala de Colores</b> </div>
                @foreach($escalas as $escala)
                  <div class="col-sm-3 col-xs-6"  style="background: #{{ $escala->fondo }}; border-right: 0.2em solid white; box-shadow: 0 1px 1px 0 #909090; color: #{{ $escala->color }};">
                    <div class="description-block border-right">
                      <span class="description-percentage" style="font-size: 25px;"><b> {{ $escala->minimo }} - {{ $escala->maximo }} % </b></span>
                      <h5 class="description-header" >{{ $escala->nombre }}</h5>
                      {{-- <span class="description-text">{{ $escala->nombre }}</span> --}}
                    </div>
                    <!-- /.description-block -->
                  </div>
                @endforeach

              </div>
            </div>

        </div>
          <!-- /.box -->
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
