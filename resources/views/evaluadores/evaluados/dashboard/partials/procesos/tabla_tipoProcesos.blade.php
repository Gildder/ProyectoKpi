<div id="contenedorTabla" class="row col-sm-12">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"  tabindex="2">
    <div class="text-left col-sm-8">
      <div>
        <label for="">Vista de Tabla:</label>
        <select name="selectVer" id="selectVer">
          <option value="0" selected>Semanal</option>
          <option value="1">Mensual</option>
        </select>
        <a id="btn-vista" href="#"  class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Mostrar</a>


        @if( \FiltroTabla::getTipo() == 1)
        <div id="filtroMes" class="row" style="margin-left: 10px; display: inline-block;">
          <label>Opciones de Vista:</label>
          <select name="selectOpcion" id="selectOpcion">
            <option value="1" selected>Ultimo Mes</option>
            <option value="2">2 Meses Atrás</option>
            <option value="3">3 Meses Atrás</option>
            <option value="0">Desde de Inicio de Año</option>
          </select>
          <a id="btn-filtroMes" href="#" class="btn btn-success btn-xs"><span class="fa fa-check"></span> Aplicar</a>
        </div>
        @endif
      </div>
    </div>
    <div class="text-right col-sm-4">
      <a  href="#" class="btn btn-warning btn-xs" title="Ver Graficos"><span class="fa fa-area-chart">  </span> </a>
      <a  href="#" class="btn btn-danger btn-xs" title="Exportar PDF"><span class="fa  fa-file-pdf-o"> Pdf </span> </a>
      <a  href="#" class="btn btn-success btn-xs" title="Exportar XLS"><span class="fa fa-file-excel-o"> Excel </span> </a>
    </div>
  </div>
  {{-- Opciones de Menu --}}
  <div id="contenedorTabla" class="row col-sm-12 table-responsive">
    @if(\FiltroTabla::getTipo() != 0)
      @include('evaluadores/evaluados/dashboard/partials/procesos/tablas/semanal')
    @else
       @include('evaluadores/evaluados/dashboard/partials/procesos/tablas/mensual')
    @endif
  </div>
    {{--Fin de Opciones de Menu --}}
</div>

{{-- Formulario de Opcion de Vista --}}
{!! Form::open([ 'id'=> 'form-vista', 'route'=> ['evaluadores.evaluados.opcionVista', ':id'], 'method' => 'POST' ]) !!}
{!! Form::close() !!}

{{-- Formalario de Filtro de Mes  --}}
{!! Form::Open(['id' => 'form-filtroMes' ,'route'=>['evaluadores.evaluados.filtroMes', ':id'], 'method'=> 'POST']) !!}
{!! Form::close() !!}


<script>
$(document).ready(function(){

    $('#btn-vista').click(function(e) {
        e.preventDefault();

        // Obtener Fomrulario
        var form = $('#form-vista');

        var button = $(this);
        var opcion = $('#selectVer option:selected').val();

        var action = form.attr('action').replace(':id', opcion);

        alert(action);
        $.post(action, form.serialize(), function (response) {
//                $('contenedorTabla').load('evaluadores/evaluados/dashboard');
                alert(response.contadorTiempo);
            }).fail(function () {
                alert('Falla');
        } );
    });


   

    /**
     * Funcion para recorre toda la tabla y pintar segun el resultado de la semana
     * segun la escala del evaluador
     */
    $("#tablaEvaluadores tbody tr").each(function ()
    {
        var valor;
        $(this).children("td").each(function ()
        {
            valor = $(this).attr('class');

            if( valor >= 0 && valor <= 79 ){
                $(this).css("background-color", "#f3d2d2");
                $(this).css("color", "#9c0006");
            }

            if(valor >= 80 && valor <= 89 ){
                $(this).css("color", "#9c6500");
                $(this).css("background-color", "#fff2ca");
            }

            if(valor >= 90 && valor <= 100 ){
                $(this).css("color", "#006100");
                $(this).css("background-color", "#dcf2cf");
            }

            if(valor > 100 ){
                $(this).css("color", "#1f4e78");
                $(this).css("background-color", "#d1e4f5");
            }

            if(valor == -1 ){
                $(this).html("-");
            }

        })

        $(this).css("font-wei", "#f3d2d2");
    });



});


</script>
