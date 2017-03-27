@extends('layouts.app')

@section('titulo')
	DashBoard
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">{!! $evaluador->abreviatura  !!} - {!! $evaluador->descripcion !!}</p>
  </div>
  <div class="panel-body">
  	      <!-- Small boxes (Stat box) -->
      <div class="row">
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
            <div class="completo">
              <p>ESta es una inforamcion de prueba</p>
            </div>
            <a href="#" class="text-{{ $item->id }}  small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach


        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tipo de Indicadores </h3>

              <!-- Tabs within a box -->
              <ul class="nav nav-tabs pull-right" >
                @foreach($tipos as $item)
                  @if($item->id == '1')
                    <li class=" tipos-{!! $item->id !!} active"  ><a href="#tipoPanel-{!! $item->id !!}" style="font-weight: bold;" data-toggle="tab"><i id="ico" class="fa "></i>   {!! $item->nombre !!}</a></li>
                  @else
                    <li class="tipos-{!! $item->id !!}"><a href="#tipoPanel-{!! $item->id !!}" data-toggle="tab"  style="font-weight: bold;"><i id="ico" class="fa "></i>   {!! $item->nombre !!}</a></li>
                  @endif
                @endforeach
              </ul>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  
                  
                    @foreach($tipos as $item)
                      @if($item->id == '1')
                        <div class="chart tab-pane active" id="tipoPanel-{!! $item->id !!}" style="position: relative; height: 300px;">
                          <div class="panel-filtros">
                            Filtros 
                          </div>
                          <div class="panel-tabla">
                            @include('evaluadores/evaluados/dashboard/partials/procesos/tabla_tipoProcesos');
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
              </div>
              <!-- /.row -->
            </div>



            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                @foreach($escalas as $escala)
                  <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-green">{{ $escala->minimo }} - {{ $escala->maximo }} %</span>
                      <h5 class="description-header">{{ $escala->nombre }}</h5>
                      {{-- <span class="description-text">{{ $escala->nombre }}</span> --}}
                    </div>
                    <!-- /.description-block -->
                  </div>
                @endforeach

              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


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
