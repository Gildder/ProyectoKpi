
$(document).ready(function(){
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('#myTableGrDepartamento').DataTable();

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
});



function agregarFormala(id)
{
	var url = 'partials/formula_'+id;
	$("#formulario").html(url);
	alert(url);
}



