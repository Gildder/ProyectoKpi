
$(document).ready(function(){
    $('#myTableGrDepartamento').DataTable();
    $('#myTable1').DataTable();
    $('#myTable2').DataTable();
    $('#myTable3').DataTable();
    $('#myTable').DataTable({
        initComplete: function () {
            this.api().columns().every( function () {
            	
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );

    /*Calendarios */
	$( ".datepicker" ).datepicker({
		format: 'dd/mm/yyyy',
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


	// from = $( ".fechaInicio" ).datepicker({
	// 	format: 'dd/mm/yyyy',
	// 	autoclose:true,
	// 	startDate: "-1m",
	// 	endDate: "+1m",
	// 	firstDay: 1,
	// 	changeMonth: true,
	// 	yearRange:1,
	// });



	// to = $( ".fechaFin" ).datepicker({
	// 	format: 'dd/mm/yyyy',
	// 	autoclose:true,
	// 	startDate: "-1m",
	// 	endDate: "+1m",
	// 	defaultDate: "+1w",
	// 	firstDay: 1,
	// 	changeMonth: true,
	// 	yearRange:1,
	// });

	$(".fechaInicio").datepicker({
		format: 'dd/mm/yyyy',
		//defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function(selectedDate) {
			$(".fechaFin").datepicker("option", "minDate", selectedDate);
		}
	});
	
	$(".fechaFin").datepicker({
		format: 'dd/mm/yyyy',
		//defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function(selectedDate) {
			$(".fechaInicio").datepicker( "option", "maxDate", selectedDate);
		}
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

    function nombreMes(nro)
    {
        $mes = 'mes';
        switch(nro)
        {

            case '1':
                $mes = 'Enero';
                break;
            case '2':
                $mes = 'Febrero';
                break;
            case '3':
                $mes = 'Marzo';
                break;
            case '4':
                $mes = 'Abril';
                break;
            case '5':
                $mes = 'Mayo';
                break;
            case '6':
                $mes = 'Junio';
                break;
            case '7':
                $mes = 'Julio';
                break;
            case '8':
                $mes = 'Agosto';
                break;
            case '9':
                $mes = 'Septiembre';
                break;
            case '10':
                $mes = 'Octubre';
                break;
            case '11':
                $mes = 'Noviembre';
                break;
            case '12':
                $mes = 'Diciembre';
                break;
        }
        return $mes;
    }
});



