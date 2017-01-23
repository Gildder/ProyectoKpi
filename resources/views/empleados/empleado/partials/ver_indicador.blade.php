
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$indicador->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Detalle del Indicador 
      </div>
      <div class="modal-body modal-delete-body">
           
          <div class="col-sm-12">
              <label  style="margin:10px 10px 0 10%; text-align:right;   width: 35%">Nro: </label>
                {{$indicador->id}} <hr>
              <label  style="margin:10px 10px 0 10%; text-align:right;  width: 35%">Objetivo: </label>
                {{$indicador->descripcion_objetivo}} {{$indicador->objetivo}}% <hr>
              <label  style="margin:10px 10px 0 10%; text-align:right;  width: 35%">Condicion: </label>
                {{$indicador->condicion}} <hr>
              <label  style="margin:10px 10px 0 10%; text-align:right;  width: 35%" >Tipo de Indicador:</label>
                {{$indicador->tipo}} <hr>
              <label  style="margin:10px 10px 0 10%; text-align:right;  width: 35%">Frecuencia:</label>
                {{$indicador->frecuencia}}  <hr>
          </div>

          <div class="col-sm-6">
          </div>

          <div class="col-sm-12">
            
          <p><b>Formula de Indicador: </b></p>
          <div style="background: #dff0d8; padding: 10px;">
                  @include('partials/formulas/formula_'.$indicador->id)
            
          </div>
          </div>


      </div>

      <div class="modal-footer modal-delete-footer">
      </div>
    </div>

  </div>
</div>
