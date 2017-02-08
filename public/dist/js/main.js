
$(document).ready(function(){
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('#myTableGrDepartamento').DataTable();

    /*Calendarios */
	$( ".datepicker" ).datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true,
		firstDay: 1,
		changeMonth: true,
		yearRange:1,
	});


	$('.timepicker').timepicker({
	    timeFormat: 'HH:mm',
	    dynamic: true,
	    dropdown: true,
	    scrollbar: true
	});


	from = $( ".fechaInicio" ).datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true,
		startDate: "-1m",
		endDate: "+1m",
		firstDay: 1,
		changeMonth: true,
		yearRange:1,
	});



	to = $( ".fechaFin" ).datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true,
		startDate: "-1m",
		endDate: "+1m",
		defaultDate: "+1w",
		firstDay: 1,
		changeMonth: true,
		yearRange:1,
	});

		
	/* Evento para cuando el usuario libera la tecla escrita dentro del input */
	$('input').blur(function(){
	    /* Obtengo el valor contenido dentro del input */
	    var value = $(this).val();
	 
	    /* Elimino todos los espacios en blanco que tenga la cadena delante y detrás */
	    var value_without_space = $.trim(value);


	    /* Reemplaza los doble espcios por uno */
	    var value_without_space = value_without_space.replace('  ', ' ');
	 
	    /* Cambio el valor contenido por el valor sin espacios */
	    $(this).val(value_without_space);
	});
	

	function agregarFormala(id)
	{
		var url = 'partials/formula_'+id;
		$("#formulario").html(url);
		alert(url);
	}


	function restaFechas(f1,f2)
	{
	    var aFecha1 = f1.split('/'); 
	    var aFecha2 = f2.split('/'); 
	    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
	    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
	    var dif = fFecha2 - fFecha1;
	    var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
	    return dias;
	}
});



