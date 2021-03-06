<div style=" width:100%; padding: 0 0.5em 0 0.5em; bottom:  10px; right: 10px;" >
<div class="col-sm-12" style="background: slategray; box-shadow: 2px 1px 8px black; border-radius: 5px 5px 0 0;" >
    <h4 style="color: white; text-align: center; text-shadow: 1px 1px 0 0 black; font-weight: bold; margin-bottom: 0.2em;">
        Escala de Colores</h4>
</div>
@foreach($escalas as $escala)
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"
         style="background: {{ $escala->color_fondo }}; color: {{ $escala->color_texto }}; box-shadow: 0 2px 2px 0 grey; font-size:100%; margin-top: 0.2em;">
        <div   class="description-block">
            <span class="description-percentage" style="font-size: 25px;"><b> {{ $escala->minimo }}
                    - {{ $escala->maximo }} % </b></span>
            <h5 class="description-header" style="color: {{ $escala->color_texto }};">{{ $escala->nombre }}</h5>
            {{-- <span class="description-text">{{ $escala->nombre }}</span> --}}
        </div>
    </div>
@endforeach
</div>  
