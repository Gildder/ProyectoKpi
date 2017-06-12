<div class="col-sm-12" style="text-align: center; background: #d2d6de; padding: 10px;  box-shadow: 1px 1px 0 0 #909090; border-right: 0.2em solid white;">
    <strong>Escala de Colores</strong>
</div>
@foreach($escalas as $escala)
    <div class="col-sm-3 col-xs-6"
         style="background: {{ $escala->color_fondo }};
         border-right: 0.2em solid white;
        box-shadow: 0 1px 1px 0 #909090;
        color: {{ $escala->color_texto }};">
        <div class="description-block border-right">
            <span class="description-percentage" style="font-size: 25px;"><b> {{ $escala->minimo }}
                    - {{ $escala->maximo }} % </b></span>
            <h5 class="description-header" style="color: {{ $escala->color_texto }};">{{ $escala->nombre }}</h5>
            {{-- <span class="description-text">{{ $escala->nombre }}</span> --}}
        </div>
    </div>
@endforeach
        