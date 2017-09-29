
$(document).ready(function(){
	//****************************************  Data Tables *******************************************************
	/* Formatos de tablas de Jquery DataTables */
    $('#myTableCargos').DataTable();
    $('#myTableEmpleado').DataTable();
    $('#myTableIndicadores').DataTable();
    $('#myTableEvaluador').DataTable();
    $('#myTableGrDepartamento').DataTable();
    $('.myDataTables').DataTable({
        dom: 'Blfrtip',
        // guarmos los filtro de la tabla
        stateSave: true,
    });
    $('#tablaTareas').DataTable();
    $('#myTableIndicadorEvalaudor').DataTable({
    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    	 "responsive": true,
    	 "autoWidth": false
    });


    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('#myTable2').DataTable();
    $('#myTable3').DataTable();
    $('#myTable4').DataTable();


    // DataTables con el dom editable
    $('#myTableDom').DataTable({
    	"dom": 'frtip'
    });
    


    $('#myTableFiltro').DataTable({
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
    });

	$('#myTableIndicadorEvalaudor').on('hidden.bs.modal', function () {
	        $('.modal-body').find('textarea,input,checkbox').val('');
	});

	//**************************************** Alert JS ***************************************************

	/* Mensajes de ALertJS */
    var alert = new Alert('#notificacion');

	//****************************************  DatePicker *******************************************************

    /*Calendarios */
	$( ".datepicker" ).datepicker({
		format: 'dd/mm/yyyy',
		autoclose:true,
		firstDay: 1,
        showWeek: true,
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
        showWeek: true,
        numberOfMonths: 1,
        showButtonPanel: true,
        beforeShowDay: $.datepicker.noWeekends,
        onSelect: function(selectedDate) {
			$(".fechaFin").datepicker("option", "minDate", selectedDate);
		}
	});
	
	$(".fechaFin").datepicker({
		format: 'dd/mm/yyyy',
		//defaultDate: "+1w",
		changeMonth: true,
        numberOfMonths: 1,
        showButtonPanel: true,
        beforeShowDay: $.datepicker.noWeekends,
        onSelect: function(selectedDate) {
			$(".fechaInicio").datepicker( "option", "maxDate", selectedDate);
		}
	});


	//**************************************** Fin DatePicker *******************************************************

		
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
	

	function agregarFormula(id)
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



