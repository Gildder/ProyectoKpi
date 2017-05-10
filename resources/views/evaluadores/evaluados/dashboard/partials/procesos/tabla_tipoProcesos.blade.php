<script>
$(document).ready(function(){

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


    /** 
     * Guardamos el estado seleccionado cada vez que se modifique el select
     */
    $('#lbsVer').change(function(){
      var option = $('#lbsVer option:selected').val();
      localStorage.setItem('selectEvalVista', option );
    });

    //  Aplicar el seleccion de cache
    var selectOption = localStorage.getItem('selectEvalVista');
    if(selectOption){
      $('#lbsVer option[value = ' + selectOption + ']').attr('selected', true);
    }


    /** 
     * Aplicamos el evento para boton Aplicar 
     */
     $('#aplicar').click(function(){
         vistaTabla();
     });


     // Por lo menos una vesz se tiene que aplicar los cambios de vista de las tablas
     vistaTabla();

    /**
     * Permite mostrar/ocultar la tabla que este sleccionada
     */
    function vistaTabla() {
        var option =  $('#lbsVer option:selected').val();

        if (option == 'semanal') {
            $('#semanal').show();
            $('#mensual').hide();
        } else {
            $('#semanal').hide();
            $('#mensual').show();
        }
    }

});

</script>


<div class="row col-sm-12">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb"  tabindex="2">
    <div class="text-left col-sm-8">
      <div>
        <label for="">Ver:</label>
        <select name="lbsVer" id="lbsVer">
          <option value="mensual">Mensual</option>
          <option value="semanal"  selected="true">Semanal</option>
        </select>
      
        <label for="" style="margin-left: 10px;">Opciones de Vista:</label>
        <select name="selectOpcion" id="selectOpcion">
          <option value="0" selected>Mes Actual</option>
          <option value="1">1 Mes Atrás</option>
          <option value="2">2 Meses Atrás</option>
          <option value="3">3 Meses Atrás</option>
          <option value="-1">Desde de Inicio de Año</option>
        </select>
        <button id="aplicar" class="btn btn-primary btn-xs">Aplicar</button>
      </div>
    </div>
    <div class="text-right col-sm-4">
      <a  href="#" class="btn btn-warning btn-xs" title="Ver Graficos"><span class="fa fa-area-chart">  </span> </a>
      <a  href="#" class="btn btn-danger btn-xs" title="Exportar PDF"><span class="fa  fa-file-pdf-o"> Pdf </span> </a>
      <a  href="#" class="btn btn-success btn-xs" title="Exportar XLS"><span class="fa fa-file-excel-o"> Excel </span> </a>
    </div>
      
  </div>
  {{-- Opciones de Menu --}}
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="btn-group pull-right" data-toggle="buttons-checkbox">
      <label for="mes" class="pull-left" style="margin-right: 10px;">Seleccionar Mes:  </label>
      <button class="btn btn-default btn-sm left">&lsaquo;</button>
      <button class="btn btn-default btn-sm "><b>Middle</b></button>
      <button class="btn btn-default btn-sm  right">&rsaquo;</button>
    </div>
    <p>El % de Cumplimiento de los Indicadores de Procesos del Mes de <i> {!! $mes !!}</i> es <b>{!! $cumplimiento !!} %</b> </p><br>
  </div>
  <div id="contenedorTabla" class="row col-sm-12 table-responsive">
    <div id="semanal">
      @include('evaluadores/evaluados/dashboard/partials/procesos/tablas/semanal')
    </div>
    <div id="mensual">
      Hola
      @include('evaluadores/evaluados/dashboard/partials/procesos/tablas/semanal')
    </div>
  </div>
</div>

