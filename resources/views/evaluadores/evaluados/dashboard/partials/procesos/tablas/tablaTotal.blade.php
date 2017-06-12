
{{-- Tabla de totales --}}
<table id="tablaEvaluadores" class="table table-bordered table-hover table-response">
  <thead class="headerTable">
    <tr style="font-weight: bold;" >
      <th>Nro</th>
      <th>Indicadores</th>
      <th title="Ponderacion">POND</th>
      <template v-for="descripcion in descripciones">
        <th>@{{ descripcion.desc }}</th>
      </template>
      <th>Promedio</th>
    </tr>
  </thead>
  <tfoot>
    <tr style="border-top: 2px solid gray;">
      <td colspan="2" align="right">El % de Cumplimiento de los Indicadores</td>
      <td><b>@{{ cumplimiento }} %</b></td>
      <template v-for="descripcion in descripciones">
        <th></th>
      </template>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
      <template  v-for="tablaDato in tablaTotalDatos">
         <tr>
          <td><a href="#" class="btn btn-warning btn-xs"> @{{ tablaDato.id }} </a></td>
          <td>@{{ tablaDato.nombre }}</td>
          <td>@{{ tablaDato.ponderacion }} %</td>
          <template v-for="dato in tablaDato.datos">
            <td>@{{ dato.valor }}</td>
          </template>
          <td>@{{ tablaDato.promedio }} %</td>
         </tr>
      </template>
  </tbody>
</table>
