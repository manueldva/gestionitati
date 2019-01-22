//var APP_URL = "{{ url('/') }}";


//$('#articulo_id').select2();
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


$('#numerodocumento').focusout(function(e) {

	/*recuper si existe cliente*/
	
	var nrodoc = $('#numerodocumento').val();
	
	$.ajax({
    	dataType: 'json',
    	//url: APP_URL + '/api/validardocumento',
    	url: '../api/validardocumento',
    	data: {q: nrodoc}
	}).done(function(data) {

		if(data !== 0) {
			if(parseInt($('#id').val()) !== parseInt(data)){
				swal({
				  title: "Ya existe un cliente con este numero de documento",
				  text: "¿Desea recuperar sus datos?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false//,
				  //showLoaderOnConfirm: true
				}, function () {
				  window.location.replace("../clientes/"+ data +"/edit");

				});
			}
		}
		
	});

});

/*buscador vendedor*/

//$(document).ready(function(){
    $('#empleado').select2({
	    /*allowClear: true,
	    multiple: true,
	    maximumSelectionSize: 1,*/
		language: {

			noResults: function() {

			return "No hay resultado";        
			},
			searching: function() {

			return "Buscando..";
			},
		},
		
        ajax : {
            //url : APP_URL + '/api/autocompleteempleadodesc',
            url : '../api/autocompleteempleadodesc',
            dataType : 'json',
            delay : 20,
            data : function(params){
                return {
                    q : params.term,
                    page : params.page
                };
            },
            processResults : function(data, params){
                params.page = params.page || 1;
                return {
                    results : data.data,
                    pagination: {
                        more : (params.page  * 10) < data.total
                    }
                };
            }
        },
		minimumInputLength: 1,
        templateResult : function (repo){
            if(repo.loading) return repo.empleado;
            var markup =  repo.empleado;
            return markup;
        },
        templateSelection : function(repo)
        {
			$("#codigovendedor").val(repo.id);
			/*$("#stock").val(repo.stock);
			$("#descripcion").val(repo.descripcion);
			$("#precio").val(repo.preciounitario);
			if($("#stock").val() !== '') $("#cantidad").val(1);*/
			
			return repo.empleado;
			
        },
        escapeMarkup : function(markup){ 
			
			return markup; 
		}
    });
//});

//buscador articulos
function buscarArticulos() {
	$('#articulo').select2({
	    /*allowClear: true,
	    multiple: true,
	    maximumSelectionSize: 1,*/
		language: {

			noResults: function() {

			return "No hay resultado";        
			},
			searching: function() {

			return "Buscando..";
			},
		},
		
        ajax : {
            //url : APP_URL + '/api/articulos',
            url : '../api/articulos',
            dataType : 'json',
            delay : 20,
            data : function(params){
                return {
                    q : params.term,
                    page : params.page
                };
            },
            processResults : function(data, params){
                params.page = params.page || 1;
                return {
                    results : data.data,
                    pagination: {
                        more : (params.page  * 10) < data.total
                    }
                };
            }
        },
		minimumInputLength: 1,
        templateResult : function (repo){
            if(repo.loading) return repo.descripcion;
            var markup =  repo.descripcion;
            return markup;
        },
        templateSelection : function(repo)
        {
			$("#articulo_id").val(repo.id);
			$("#stockarticulo").val(repo.stock);
			$("#descripcionarticulo").val(repo.descripcion);
			if($("#stockarticulo").val() !== '') $("#cantidadarticulo").val(1);
			
			return repo.descripcion;
			
        },
        escapeMarkup : function(markup){ 
			
			return markup; 
		}
    });
}

buscarArticulos();


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
	
	//$("#codigo").val('');
	//$("#descripcion").val('');
	//$("#precio").val('');
	//prueba para descontar stock
	//$("#stock").val(parseInt(parseInt($("#stock").val()) - $("#cantidad").val()));
	$("#cantidadarticulo").val(1);

	toastr.success('Articulo agregado a la lista');
	

});


/*borrar filas del listado de articulos*/
function deletearticulo_row(row) {
	/*var subtotal = row.closest('tr').find("td").eq(6).html();
	var cantidad = row.closest('tr').find("td").eq(2).html();
	var cantidadActualArticulo = $("#txtCantidadArticulos").val();

	cantidadActualArticulo = parseInt(cantidadActualArticulo) - parseInt(cantidad);
	$("#txtCantidadArticulos").val(cantidadActualArticulo);

	subtotal = parseFloat(-subtotal.slice(1));
	actualizar_total_proforma(subtotal);*/
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
	
	//$("#codigo").val('');
	//$("#descripcion").val('');
	//$("#precio").val('');
	//prueba para descontar stock
	//$("#stock").val(parseInt(parseInt($("#stock").val()) - $("#cantidad").val()));
	$("#vinculo_id").val('');
	$("#nombrevinculo").val('');
	$("#contactovinculo").val('');


	toastr.success('Familiar agregado a la lista');
	

});


/*borrar filas del listado de familiares*/
function deletefamiliar_row(row) {
	/*var subtotal = row.closest('tr').find("td").eq(6).html();
	var cantidad = row.closest('tr').find("td").eq(2).html();
	var cantidadActualArticulo = $("#txtCantidadArticulos").val();

	cantidadActualArticulo = parseInt(cantidadActualArticulo) - parseInt(cantidad);
	$("#txtCantidadArticulos").val(cantidadActualArticulo);

	subtotal = parseFloat(-subtotal.slice(1));
	actualizar_total_proforma(subtotal);*/
  	row.closest('tr').remove();
  	toastr.info('Familiar eliminado de la lista');
}




$( "#guardar" ).click(function() {
   //$('#form').submit();
});