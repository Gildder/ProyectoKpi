
$(document).ready(function(){
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('#myTableGrDepartamento').DataTable();

});



function agregarFormala(id)
{
	var url = 'partials/formula_'+id;
	$("#formulario").html(url);
	alert(url);
}