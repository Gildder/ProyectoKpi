
    <div class="chart">
      <div id="chart_div"></div>
    </div>



<script>
    

$(document).ready(function(){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);


    function drawVisualization() 
    {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Mes', 'Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Semana 5'],
        @foreach($listaGraficas as $item)
          ['{{ $item[0] }}', {{ $item[1] }}, {{ $item[2] }}, {{ $item[3] }}, {{ $item[4] }}, {{ $item[5] }}],
        @endforeach
    ]);

    var options = {
      // title : 'Eficacia del Servicio',
      vAxis: {title: 'Eficiencia %', maxValue: '100', format: '#' , gridlines:{count: 10}},
      hAxis: {title: 'Meses', textStyle:{ bold: true}},
      legend : { maxLines:2, position: 'top', textStyle: { fontSize: 12}},
      seriesType: 'bars',
      series: {5: {type: 'bares'}},
      height: 400,
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
});

 
</script>