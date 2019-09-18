
<input type="hidden" name="listado_hojaruta" id="id_lista_hojaruta">

<input type="hidden" name="listado_articulos" id="id_lista_articulos">

<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">


	      <h3 class="box-title">
	      	
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Ingresar parametros para generar una hoja de ruta:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('fecha', 'Fecha') }}
						{{ form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
					</div>

			    	<div class="form-group">
						{{ form::label('empleado_id', 'Vendedor *') }}
						{{ form::select('empleado_id',  $empleados, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
					</div>

					<div class="form-group">
						{{ form::label('sinbarrio_id', 'Sin Barrio') }}
						{{ form::select('sinbarrio_id',  ['0' => 'Sin Barrio'], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
					</div>
					
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio') }}					
						{{ form::select('barrio_id',  [], null, ['class' => 'form-control', 'multiple'=> 'multiple'] ) }} 
					</div>
					<div class="form-group">
						<a type="button" id="buscarruta" name="buscarruta" class="btn btn btn-success">
							<span class="glyphicon glyphicon-search">
		                    </span>
		                    Buscar
		                </a>
					</div>
			      
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<!-- aca agregar el div col-6 -->

	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
<!--      segundo div general                              -->
	<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">


	      <h3 class="box-title">
	      	<strong id="cantidad_domicilio">
	      		
	      	</strong>
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="form-group">
				<div class="table-responsive">
					<table   id="table_hojaruta" class="table table-striped table-hover" data-form="Form">
						<thead>
							<tr>
							<!--<th width="10px"> ID</th>-->
								<tr>
									
									<th style="display: none;">
										<center>
											DireccionID
										</center>
									</th>
									
						            <th>
										<center>
											<i></i>  Nro Cliente
										</center>	
									</th>
									<th>
										<center>
											<i></i> Cliente
										</center>	
									</th>
									
									<th>
										<center>
											<i></i> Dirección
										</center>
									</th>
									<th>
										<center>
											<i></i> Articulo
										</center>
									</th>
									<th>
										<center>
											<i></i> Cantidad
										</center>
									</th>
									<th style="display: none;">
										<center>
											<i></i> Articulo_id
										</center>
									</th>
									

								</tr>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div id="table_hojarutaspan" class="form-group has-error" style="display: none">
						<span class="help-block">Debe haber al menos un registro en la lista</span>
					</div>
				</div>
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>	
	
	</div>	 
<!--      segundo div general                              -->
	</div>
	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		$('#barrio_id').select2();
		$('#distrito_id').select2();

		var APP_RL = "{{ url('/') }}";


		/*para combos de domicilio*/
		$('#empleado_id').on('change', function(e){
		    console.log(e);
		    var empleado_id = e.target.value;

		    $.get('{{ url("/") }}/api/hojaruta_barrios?empleado_id=' + empleado_id,function(data) {

		      $('#barrio_id').empty();
		      $("#table_hojaruta").find("tr:gt(1)").remove();
		      //$('#departamento_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			 
		      $.each(data, function(fetch, barrio){
		        console.log(data);
		        if(barrio.localidad_id !== 1) {
		        	$('#barrio_id').append('<option value="'+ barrio.id +'">'+ barrio.descripcion +' - ' + barrio.localidad + '</option>');
		        } else {
		        	$('#barrio_id').append('<option value="'+ barrio.id +'">'+ barrio.descripcion +'</option>');
		        }
		        
		      })
		    });

		    /*id2 = $("#provincia_id option:selected").val();
		    cargar_departamentos(id2);*/
		});


		$('#barrio_id').on('change', function(e){

		    $("#table_hojaruta").find("tr:gt(1)").remove();
		});





		//buscador articulos
		function buscarArticulos(articulo_id) {

			//alert(articulo_id);

			if (articulo_id !== '') {
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/articulos',
				//url: '../api/validardocumento',
				data: {q: articulo_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data !== 0) {
					$("#articulo_id").val(data.id);
					$("#articulo").val(data.id);


					//$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
					//toastr.info('Codigo de vendedor correcto');
				} else{
					$("#articulo_id").val('');
					$("#articulo").val('');
					$("#cantidadarticulo").val('');
					
				}
				
			});
			} else {
				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');
			}
		}


		$('#articulo_id').focusout(function(e) {

			buscarArticulos($('#articulo_id').val());

		});

		$(document).ready(function(){
			$("#articulo_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
			var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					if ($('#articulo_id').val() == '') $('#articulo').val(''); 
					buscarArticulos($('#articulo_id').val());

				}
			});
		});

		$('#articulo').on('change', function(e){
			if ($('#articulo').val() == '') $('#articulo_id').val(''); 
			buscarArticulos($('#articulo').val());
		});


		/*para agregar articulos al listado*/
		$( "#agregararticulo" ).click(function() {

			
			if($('#articulo_id').val() == ''  || $("#cantidadarticulo").val() == '') {


				toastr.error('No se puede agregar este articulo. Faltan datos');
				return false;
			}

			if(parseInt($("#cantidadarticulo").val()) < 1) {


				toastr.error('La cantidad ingresada no puede ser menor a 1');
				return false;
			}

			//variables para guardar en la grilla
			var codigo = $('#articulo_id').val();
			//var descripcion = $("#descripcionarticulo").val();
			var descripcion =$('select[name="articulo"] option:selected').text();
			var cantidad = parseInt($('#cantidadarticulo').val());

			//validar que no se repita el mismo precio
			
			existearticulo = 0;
			$('#table_articulos tbody tr').each(function () {	 
		    	articulo_idtemp = $(this).find("td").eq(0).html();
		    	if(articulo_idtemp == codigo) {
		    		
		    		existearticulo = 1;
		    	}
		    	
		    });

		    if(existearticulo == 1){
		    	toastr.error('Este articulo ya existe en la lista');
		    	return false;
		    }
			
			//

			//cargo la grilla
			$('#table_articulos tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

			toastr.success('Articulo agregado a la lista');
			
				/*$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');*/
			buscarArticulos(0);

		});



		/*para agregar articulos al listado*/
		$( "#buscarruta" ).click(function() {
			

				var barrio_uldiv = $('#barrio_id').siblings('span.select2').find('ul')
				var barrio_count = barrio_uldiv.find('li').length - 1;
				//alert(count);
				//uldiv.html("<li>"+count+" items selected</li>")

			if($('#empleado_id').val() == '') {


				toastr.error('Debe seleccionar un vendedor para realizar la busqueda');
				return false;
			}

			if($('#barrio_id').val() == '') {


				toastr.error('Debe seleccionar un barrio para realizar la busqueda');
				return false;
			}

			$("#table_hojaruta").find("tr:gt(1)").remove();
				
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/buscarruta',
				//async: false,
				//url: '../api/validardocumento',
				data: {e: $('#empleado_id').val(), b: $('#barrio_id').val(), o: $('#orden').val()}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

					$.each(data, function(key, value){
						//$("#rubro_caja").append('<option value="'+value.id+'">'+value.numero+' '+value.letra+'</option>');
						var direccion = '';

						if(barrio_count > 1){
							direccion = 'B° ' + value.barrio;
						}


						if(value.calle){
							direccion = direccion + ' Calle ' + value.calle;
						}

						if(value.numero){
							direccion = direccion + ' Nro. ' + value.numero;
						}

						if(value.manzana){
							direccion = direccion + ' Mz. ' + value.manzana;
						}

						if(value.casa){
							direccion = direccion + ' C. ' + value.casa;
						}

						if(value.seccion){
							direccion = direccion + ' Seccion ' + value.seccion;
						}


						if(value.lote){
							direccion = direccion + ' Lote ' + value.lote;
						}

						if(value.edificiotorre){
							direccion = direccion + ' Edificio ' + value.edificiotorre;
						}

						if(value.piso){
							direccion = direccion + ' Piso/Dpto ' + value.piso;
						}

						if(value.referenciadomicilio){
							direccion = direccion + ' Ref. ' + value.referenciadomicilio;
						}




						$('#table_hojaruta tbody').prepend(
						'<tr>' + 
						'<td style="display: none;"><center>' + value.clientedireccion_id + '</center></td>' +
						'<td><center>' + value.cliente_id + '</center></td>' +
						'<td><center>' + value.cliente +'</center></td>' +
						'<td><center>' + direccion + '</center></td>' +
						'<td><center>' + value.articulo + '</center></td>' +
 						'<td><center><div contenteditable="true"><font color="green">'+value.cantidad+'</font></div></td>' +
 						'<td style="display: none;"><center>' + value.articulo_id + '</center></td>' +
						"<td><center><a class='delete btn btn-sm btn-danger' onclick ='deletearticulohoja_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
						'</tr>');
			    	})

					//cargo la grilla
					



					toastr.success('Hoja ruta generada correctamente');

				
			});
		

			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojaruta_cant_docimicilios',
				//async: false,
				//url: '../api/validardocumento',
				data: {e: $('#empleado_id').val(), b: $('#barrio_id').val()}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

				 $("#cantidad_domicilio").text('Domicilios a visitar: ' + data);

			});
		
			
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulohoja_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}


		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}


		


		$( "#guardar" ).click(function() {


			$( "#guardar" ).hide();

			if($('#empleado_id').val() == '') {

				$( "#guardar" ).show();
				toastr.error('Debe seleccionar un vendedor para realizar la busqueda');
				return false;
			}

			if ($('#sinbarrio_id').val() !== '0') {

				

				if($('#barrio_id').val() == '') {

					$( "#guardar" ).show();
					toastr.error('Debe seleccionar un barrio para realizar la busqueda');
					return false;
				}


			   // listado de articulos
			    var listado = crear_listado_hojaruta();
	      		$('#id_lista_hojaruta').val(listado);

	      		if ($('#id_lista_hojaruta').val() == ''){
	      			estadocampos = 1;
				   	$('#table_hojarutaspan').show();
	      		} else {
	      			estadocampos = 0;
	      			$('#table_hojarutaspan').hide();
	      		}

	      		var listado2 = crear_listado_articulos();
	      		$('#id_lista_articulos').val(listado2);
	      		//alert($('#id_lista_hojaruta').val());

	      		
	      		if(estadocampos == 1) 
	      		{
	      			$( "#guardar" ).show();
	      			toastr.error('No se puede guardar la hoja. Faltan datos');
	      			return false;
	      		} else {
	      			$('#form').submit();
      			}
      		} else {
      			$('#form').submit();
      		}
			
			/*if ($('#id_lista_hojaruta').val() !== ''){
		   		$('#form').submit();
		   	}*/

		});

		function crear_listado_hojaruta() {
		    var listado = '';
		    

		    $("#id_lista_hojaruta").val('');

		    $('#table_hojaruta tbody tr').each(function () {	 
		    direccion_id = $(this).find("center").eq(0).html();
		    cliente_id = $(this).find("center").eq(1).html();
		    //articulo = $(this).find("center").eq(5).html();
		    cantidad =  $(this).find("center").eq(5).text();
		    articulo_id =  $(this).find("center").eq(6).html();
		    //contrato_id =  $(this).find("center").eq(8).html();

		    //cantidad = cantidad.textContent();
		   

		    listado += direccion_id + "|" + cliente_id  + "|" + cantidad + "|" + articulo_id + "&&&";
		    });

		      return listado;
	    }


	    function crear_listado_articulos() {
		    var listado = '';
		    

		    $("#id_lista_articulos").val('');

		    $('#table_articulos tbody tr').each(function () {	 
		    codigo = $(this).find("td").eq(0).html();
		    cantidad = $(this).find("td").eq(2).html();

		    //cantidad = cantidad.textContent();
		   

		    listado += codigo + "|" + cantidad + "&&&";
		    });

		      return listado;
	    }



	</script>

@endpush