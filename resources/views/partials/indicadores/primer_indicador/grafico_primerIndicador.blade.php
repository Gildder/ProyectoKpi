<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
<!-- BAR CHART -->
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Bar Chart</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <div id="chart_div"></div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->


<script>
    

$(document).ready(function(){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);


    function drawVisualization() 
    {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Mes', 'Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
        @foreach($grafico as $item)
          ['{{ $item->mes}}', {{ $item->semana}}, {{ $item->actpro}}, {{ $item->actrea}}, {{ $item->efeser}}],
        @endforeach
    ]);

    var options = {
      title : 'Eficacia del Servicio',
      vAxis: {title: 'Eficiencia %', maxValue: '105', format: '#' },
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'bares'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
});

 
</script>