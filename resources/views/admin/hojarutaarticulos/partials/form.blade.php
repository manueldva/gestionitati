
<input type="hidden" name="listado_hojaruta" id="id_lista_hojaruta">


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
						{{ form::label('articulo_id', 'Vendedor *') }}
						{{ form::select('articulo_id',  $articulos, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
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
									<th style="display: none;">
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

		$('#articulo_id').select2();
		//$('#distrito_id').select2();

		var APP_RL = "{{ url('/') }}";


		/*para agregar articulos al listado*/
		$( "#buscarruta" ).click(function() {
			

			if($('#articulo_id').val() == '') {


				toastr.error('Debe seleccionar un articulo para realizar la busqueda');
				return false;
			}


			$("#table_hojaruta").find("tr:gt(1)").remove();
				
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/buscarrutaarticulo',
				//async: false,
				//url: '../api/validardocumento',
				data: {e: $('#articulo_id').val()}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

					$.each(data, function(key, value){
						//$("#rubro_caja").append('<option value="'+value.id+'">'+value.numero+' '+value.letra+'</option>');
						var direccion = '';

						
						direccion = 'B° ' + value.barrio;
						

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
						'<td style="display: none;"><center>' + value.articulo + '</center></td>' +
 						'<td><center><div contenteditable="true"><font color="green">'+value.cantidad+'</font></div></td>' +
 						'<td style="display: none;"><center>' + value.articulo_id + '</center></td>' +
						"<td><center><a class='delete btn btn-sm btn-danger' onclick ='deletearticulohoja_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
						'</tr>');
			    	})

					//cargo la grilla
					



					toastr.success('Hoja ruta generada correctamente');

				
			});
		
			/*
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojaruta_cant_docimicilios',
				//async: false,
				//url: '../api/validardocumento',
				data: {e: $('#articulo_id').val(), b: $('#barrio_id').val()}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

				 $("#cantidad_domicilio").text('Domicilios a visitar: ' + data);

			});*/
		
			
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulohoja_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}



		


		$( "#guardar" ).click(function() {


			if($('#articulo_id').val() == '') {


				toastr.error('Debe seleccionar un articulo para realizar la busqueda');
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


      		if(estadocampos == 1) 
      		{
      			toastr.error('No se puede guardar la hoja. Faltan datos');
      			return false;
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


	   


	</script>

@endpush