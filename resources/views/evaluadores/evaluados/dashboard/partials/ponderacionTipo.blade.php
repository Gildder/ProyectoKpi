<!-- Panel de Tipos de Indicadores-->
@foreach($tipos as $tipo)
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="{{ $tipo->color_fondo }} small-box">
            <div class="inner">
                <h3>{{ $tipo->ponderacion}}<sup style="font-size: 20px">%</sup></h3>

                <p>{{ $tipo->nombre}}</p>
            </div>
            <div class="icon">
                <i id="ico" class="{{ $tipo->icono }}"></i>
            </div>
            {{--   <div class="completo">
                <p>Esta es una inforamcion de prueba</p>
              </div> --}}
            <a href="#"
               class=" small-box-footer">{{-- Mas Informacion <i class="fa fa-arrow-circle-right"></i> --}}</a>
        </div>
    </div>
@endforeach
