  <!--Div that will hold the pie chart-->
    <div class="chart">
        <div>
            {{--Aqui colocamos los filtros--}}
        </div>
        <div id="chart_Eficacia"></div>
    </div>

<!-- Load the AJAX API-->
<script type="text/javascript">

$(document).ready(function(){
  var chart;
  var chartData = [
      @foreach($listaGraficas as $item)
        [ 
          <?php  $contador = 0; $limite = date('n', now()); ?>
          <?php while ($contador < $limite) {
    ?>
            @if($contador == 0)
              '{{ $item[$contador] }}',
            @else
              @if($item[$contador] != null)
                {{ $item[$contador] }}
              @else
                null
              @endif
              @if($contador < $limite - 1 )
                ,
              @endif
            @endif
            <?php $contador++; ?>
          <?php 
} ?>
        ],
      @endforeach
  ];

  chart = c3.generate({
    bindto: "#chart_Eficacia",
    data: {
        type: 'bar',
        columns: chartData
    },
    axis: {
      x: {
          type: 'category',
          // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
          categories: [
            @foreach(\LabelApps::getArrayMesD3() as $mes) 
              '{{ $mes }}',
            @endforeach
          ]
      }
    },
    legend: {
      position: 'right'
    }
  });


// Fin document   
});

</script>
