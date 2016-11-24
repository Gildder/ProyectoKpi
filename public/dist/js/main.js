	$('#nuevo').click(function(e){
		$("#formNuevo").slideDown();
		$("#nuevo").css("display", "none");
		e.preventDefault();

	});

	$('#editar').click(function(e){
		$("#formNuevo").slideDown();
		$("#nuevo").css("display", "none");
		e.preventDefault();

	});

	$('#cancelar').click(function(e){
		$("#formNuevo").slideUp();
		$("#nuevo").css("display", "block");
		e.preventDefault();
	});


	$('#guardar').click(function(e){

		var name = $('nombre').val();

		var route = "{{route('localizaciones.grupodepartamento.store')}}";
		var dataString = "nombre" + name;

		$.ajax({
			url: route,
			type: 'post',
			datatype: 'json',
			data: dataString,

			success: function(data)
			{
				if (data.success == 'true') {
					alert('inserto');
					document.location.href = route;
				}
			},

			error:function(data)
			{
				$("#message-error").css("display", "block");
				$("#error").html(data.responseJSON.name);
				$("#message-error").facein();
			}

		})
	});


$('#actualizar').click(function(e){

		var name = $('nombre').val();

		var route = "{{route('localizaciones.grupodepartamento.update')}}";
		var dataString = "nombre" + name;

		$.ajax({
			url: route,
			type: 'post',
			datatype: 'json',
			data: dataString,

			success: function(data)
			{
				if (data.success == 'true') {
					document.location.href = route;
				}
			},

			error:function(data)
			{
				$("#message-error").css("display", "block");
				$("#error").html(data.responseJSON.name);
				$("#message-error").facein();
			}

		})
	});



$(document).ready(function(){
    $('#myTable').DataTable();
	//$("#formNuevo").css("display", "none");
	//$(".alert").css("display", "none");

});

function editar($id)
{
	alert($id)
}