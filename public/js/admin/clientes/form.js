
$('#provincia_id').select2();
$('#localidad_id').select2();
$('#barrio_id').select2();
$('#calle_id').select2();


/*para calcular edad a partir de una fecha de nacimientpo*/
function calcularEdad() {
	FechaNacimiento = $('#fechanacimiento').val();
	var fechaNace = new Date(FechaNacimiento);
	var fechaActual = new Date()
	var mes = fechaActual.getMonth();
	var dia = fechaActual.getDate();
	var año = fechaActual.getFullYear();
	fechaActual.setDate(dia);
	fechaActual.setMonth(mes);
	fechaActual.setFullYear(año);
	edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));
	//return edad;
	if(!isNaN(edad)) {
		$('#edad').val(edad);
	}
	
}

calcularEdad();

$('#fechanacimiento').focusout(function(e) {
	CalcularEdad();
});


/*mostrar campos dependiendo del tipo del cliente*/
function habilitarCliente(){
	if ($("#tipocliente_id").val() == '1'){
		$("#razonsocial").hide();
		$("#apellidoynombre").show();
		$("#referentes").hide();
		$("#tipoivas").hide();
		$("#cuits").hide();
	} else {
		$("#razonsocial").show();
		$("#apellidoynombre").hide();
		$("#referentes").show();
		$("#tipoivas").show();
		$("#cuits").show();
	}

}

habilitarCliente();

$('#tipocliente_id').change(function(e) {
	habilitarCliente();
});

/**/


/*para agregar articulos al listado*/
$( "#agregararticulo" ).click(function() {

	/*para validar que no supere el stock ya ingresado en la grilla*/
	var stocktemp = 0;
	$('#table_ventas tr').each(function(index, element) {
	    codigotemp = $(element).find("td").eq(0).text();
	    cantidadtemp = $(element).find("td").eq(2).text();

	    if(codigotemp == $("#articulo_id").val())
	    {
	    	stocktemp = stocktemp + parseInt(cantidadtemp);
	    }
	   
	    //alert(codigotemp);

	});

	stocktemp = parseInt($("#stockarticulo").val()) - stocktemp;
	/**/
	
	/*validaciones*/ 
	if($("#stockarticulo").val() == ''  || $("#cantidadarticulo").val() == '') {
		swal({
			title: 'No se puede agregar este articulo',
			text: 'faltan algunos datos',
			type: 'error',
			//confirmButtonColor: '#DD6B55',
			confirmButtonText: 'OK!',
			closeOnConfirm: false
		});
		return false;
	} else if(parseInt($("#cantidadarticulo").val()) < 1) {
		swal({
			title: 'No se puede agregar este articulo',
			text: 'Debe ingresar una cantidad mayor o igual a 1',
			type: 'error',
			//confirmButtonColor: '#DD6B55',
			confirmButtonText: 'OK!',
			closeOnConfirm: false
		});

		return false;

	} else if(stocktemp < parseInt($("#cantidadarticulo").val())) {
		swal({
			title: 'No se puede agregar este articulo',
			text: 'El stock actual es menor a la cantidad ingresada',
			type: 'error',
			//confirmButtonColor: '#DD6B55',
			confirmButtonText: 'OK!',
			closeOnConfirm: false
		});

		return false;
	}

	/**/
	
	//variables para guardar en la grilla
	var codigo = $("#articulo_id").val();
	var descripcion = $("#descripcionarticulo").val();
	var cantidad = parseInt($("#cantidadarticulo").val());
	
	//cargo la grilla
	$('#table_articulos tbody').prepend(
		'<tr>' + 
		'<td style="display:none;">' + codigo + '</td>' +
		'<td>' + descripcion + '</td>' +
		'<td>' + cantidad + '</td>' +
		"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
		'</td>' +
		'</tr>');
	
	$("#cantidadarticulo").val(1);

	toastr.success('Articulo agregado a la lista');
	

});


/*borrar filas del listado de articulos*/
function deletearticulo_row(row) {

  	row.closest('tr').remove();
  	toastr.info('Articulo eliminado de la lista');
}



/*para agregar familiares al listado*/
$( "#agregarfamiliares" ).click(function() {

	/*validaciones*/ 
	if($("#nombrevinculo").val() == ''  || $("#contactovinculo").val() == ''  || $("#vinculo_id").val() == '') {
		swal({
			title: 'No se puede agregar este articulo',
			text: 'faltan algunos datos',
			type: 'error',
			//confirmButtonColor: '#DD6B55',
			confirmButtonText: 'OK!',
			closeOnConfirm: false
		});
		return false;
	} 
	/**/
	
	//variables para guardar en la grilla
	var vinculo_id = $("#vinculo_id").val();
	var vinculo = $('select[name="vinculo_id"] option:selected').text();
	var nombrevinculo = $("#nombrevinculo").val();
	var contactovinculo = $("#contactovinculo").val();
	
	//cargo la grilla
	$('#table_familiares tbody').prepend(
		'<tr>' + 
		'<td style="display:none;">' + vinculo_id + '</td>' +
		'<td>' + vinculo + '</td>' +
		'<td>' + nombrevinculo + '</td>' +
		'<td>' + contactovinculo + '</td>' +
		"<td><a class='delete btn btn-sm btn-danger' onclick ='deletefamiliar_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
		'</td>' +
		'</tr>');
	
	$("#vinculo_id").val('');
	$("#nombrevinculo").val('');
	$("#contactovinculo").val('');


	toastr.success('Familiar agregado a la lista');
	

});


/*borrar filas del listado de familiares*/
function deletefamiliar_row(row) {

  	row.closest('tr').remove();
  	toastr.info('Familiar eliminado de la lista');
}




$( "#guardar" ).click(function() {
   //$('#form').submit();

   alert('hello');
});