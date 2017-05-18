<!-- Panel de Tipos de Indicadores-->
@foreach(\Cache::get('evadores')->ponderacion->tipoIndicadores as $item)
    <div class="col-lg-3 col-xs-6">
        <div class="{{ $item->getFondo($item->id) }} small-box">
            <div class="inner">
                <h3>{{ $item->pivot->ponderacion}}<sup style="font-size: 20px">%</sup></h3>

                <p>{{ $item->nombre}}</p>
            </div>
            <div class="icon">
                <i id="ico" class="{{ $item->getIcon($item->id) }}"></i>
            </div>
            {{--   <div class="completo">
                <p>Esta es una inforamcion de prueba</p>
              </div> --}}
            <a href="#"
               class=" small-box-footer">{{-- Mas Informacion <i class="fa fa-arrow-circle-right"></i> --}}</a>
        </div>
    </div>
@endforeach
