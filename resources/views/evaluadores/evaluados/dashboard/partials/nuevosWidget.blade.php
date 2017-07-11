<div class="row" id="nuevoWidget" style="display: none;">
    <div class="col-md-12">
        <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> Nuevo Widget</h3>

        <div class="box-tools pull-right">
            <button type="button" @click="abrirWidget" class="btn btn-box-tool" data-widget="toggle"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body " style="border: 1px dashed grey" >
        <ul style="padding-left: 0px;">
        @foreach($widgets as $widget)
            <fila-widget
                    :id="{{ $widget->id  }}"
                    titulo=" {{ $widget->titulo }}"
                    descripcion="{{ $widget->descripcion }}" >
            </fila-widget>
            <nuevo-modal :tipo_id="{{ $widget->id }}" titulo="{{ $widget->titulo }}"></nuevo-modal>

        @endforeach

        </ul>
    </div>
</div>
</div>
</div>
