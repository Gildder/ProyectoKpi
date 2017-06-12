<div class="col-ms-12 col-xs-12 box" id="nuevoWidget" style="display: none;">
    <div class="box-header with-border">
        <h3 class="box-title"> Nuevo Widget</h3>

        <div class="box-tools pull-right">
            <button type="button" @click="abrirWidget" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body col-xs-12 col-ms-6 col-md-6 col-lg-6" style="border: 1px dashed grey" >
        <table class="table-striped  col-lg-12" >
            <tbody>
            @foreach($widgets as $widget)
                <tr>
                    <th>
                        <div style="display: inline-block;">
                            <span class="fa fa-pie-chart"></span>
                        </div>
                        <div style="display: inline-block; ">
                            <div hidden>{{ $widget->id }}</div>
                            <strong>{{ $widget->titulo }}</strong><br>
                            <p style="font-style: italic; font-size: small;"> {{ $widget->descripcion }}</p>
                        </div>
                    </th>
                    <th>
                        <div class="botones" style="bottom: -10px; float: right; margin: 10px; padding: 5px;">
                            <a  href="#" class="btn btn-primary btn-xs"><span class="fa fa-pie-chart"></span> Agregar Widget</a>
                        </div>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>