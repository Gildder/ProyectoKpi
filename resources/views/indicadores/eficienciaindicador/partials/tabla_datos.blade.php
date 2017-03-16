<div class="col-lg-12">

	 <div class="table-response">
	    <table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
	       <thead>
	          <th>Nro</th>
	          <th>Nombre</th>   
	          <th  class="hidden-xs">Estado</th>   
	          <th >Opciones</th>
	       </thead>

	       <tbody>
	       @foreach($indicadores as $item)
	          <tr>
	             <td>{{$item->id}}</td>
	             <td>{{$item->nombre}}</td>
	             <td  class="hidden-xs">@if($item->estado == '1') <span class="btn-success  btn-xs">Habilitado</span> @else <span class="btn-danger btn-xs">Desabilitado</span> @endif </td>
	             <td>
	                <a  data-toggle="modal" data-target="#modal-delete-{{$item->id}}" class="btn btn-primary btn-sm"><span class=""  title="Quitar"></span><span >Quitar</span></a>
	             </td>
	          </tr>
	       @endforeach
	       </tbody>
	 
	    </table>
	 </div>
</div>
