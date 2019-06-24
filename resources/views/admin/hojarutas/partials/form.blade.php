
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
						{{ form::label('empleado_id', 'Vendedor *') }}
						{{ form::select('empleado_id',  $empleados, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
					</div>
					
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio') }}					
						{{ form::select('barrio_id',  $barrios, null, ['class' => 'form-control', 'multiple'=> 'multiple'] ) }} 
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

			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			      <h3 class="box-title">Articulos del Stock:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
					
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>	
									<td class="col-md-3"> 
										{{ form::label('articulo_id', 'Cod.') }}
										{{ form::number('articulo_id', null, ['class' => 'form-control', 'id' => 'articulo_id']) }}
									</td>
									<td>
										{{ form::label('articulo', 'Articulo') }}
										<br>
										{{ form::select('articulo', [],  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
									</td>
									<td> 
										
									</td>
								</tr>

								
							</thead>
						</table>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_articulos" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Articulo</th>
											<th> </th>
										</tr>
									</thead>
									<tbody>
										@isset($stockdetalles)
											@foreach ($stockdetalles as $stockdetalle)
							                  <tr>
							                    <td style="display:none;">{{ $stockdetalle->articulo_id }}</td>
							                    <td>{{ $stockdetalle->articulo->descripcion }}</td>
								                    <td>
								                    	@if($show == 1)
										                   <a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'>
										                   	<span class='glyphicon glyphicon-trash'></span>
										                   </a>
										                @endif
								               	    </td>
							                   
							                  </tr>
							                @endforeach
										@endif
									</tbody>
								</table>
								<div id="table_hojarutaspan" class="form-group has-error" style="display: none">
									<span class="help-block">Debe haber al menos un registro en la lista</span>
								</div>
							</div>
						</div>
					</div>
				  </div>

			    </div>
			    <!-- /.box-body -->
			</div>

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
						            <th>
										<center>
											<i></i>  Nro Cliente
										</center>	
									</th>
									<th>
										<center>
											<i></i>  Fecha Contrato
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
								</tr>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div id="table_articulosspan" class="form-group has-error" style="display: none">
						<span class="help-block">Debe haber al menos un registro en la lista</span>
					</div>
				</div>
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>	
	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		$('#barrio_id').select2();
		$('#distrito_id').select2();

		var APP_RL = "{{ url('/') }}";


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
					
				}
				
			});
			} else {
				$("#articulo_id").val('');
				$("#articulo").val('');
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
		$( "#buscarruta" ).click(function() {
			

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
				data: {e: $('#empleado_id').val(), b: $('#barrio_id').val()}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

					$.each(data, function(key, value){
						//$("#rubro_caja").append('<option value="'+value.id+'">'+value.numero+' '+value.letra+'</option>');
						var direccion = '';

						direccion = 'B° ' + value.barrio;

						if(value.calle){
							direccion = direccion + ' Calle ' + value.barrio;
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
						'<td style="display: none;">' + value.id + '</center></td>' +
						'<td><center>' + value.cliente_id + '</center></td>' +
						'<td><center>' + value.fechacontrato + '</center></td>' +
						'<td><center>' + value.apellido +' '+ value.nombre  + '</center></td>' +
						'<td><center>' + direccion + '</center></td>' +
						'<td><center>' + value.articulo + '</center></td>' +
						'<td><center><input type="number" class="text-center" name="cantidad[]"  value="'+value.cantidad+'" contenteditable="true" min="0" style="border: none;"></center></td>' +


						"<td><center><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
						'</td>' +
						'</tr>');
			    	})

					//cargo la grilla
					



					toastr.success('Hoja ruta generada correctamente');

				
			});
		

			
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}


		
		function deletecontrato_row(row) {

		  	 var contrato_id = row.parents("tr").find('td').eq(0).html();
 			// aqui va codigo para la eliminacion
 			
            $.ajax({
				dataType: 'json',
				url: APP_URL + '/eliminarcontrato/' + contrato_id
				//url: '../api/validardocumento',
				//data: {id: contrato_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data == 0) {
					row.closest('tr').remove();
		  			toastr.info('Articulo eliminado de la lista');
					
				}
				
			});
		}




		$( "#guardar" ).click(function() {


			estadocampos = 0;

			if ($('#stockminimo').val() == ''){
      			estadocampos = 1;
			   	$('#stockminimospan').show();
      		} else {
      			$('#stockminimospan').hide();
      		}
      		if ($('#sucursal_id').val() == ''){
      			estadocampos = 1;
			   	$('#sucursal_idspan').show();
      		} else {
      			$('#sucursal_idspan').hide();
      		}



		   // listado de articulos
		    var listado = crear_listado_articulos();
      		$('#id_lista_articulos').val(listado);

      		if ($('#id_lista_articulos').val() == ''){
      			estadocampos = 1;
			   	$('#table_articulosspan').show();
      		} else {
      			$('#table_articulosspan').hide();
      		}

      		
      		if(estadocampos == 1) 
      		{
      			toastr.error('No se puede guardar el stock. Faltan datos');
      			return false;
      		} else {
      			$('#form').submit();
      		}


		   	//$('#form').submit();

		});

		function crear_listado_articulos() {
		    var listado = '';
		    

		    $("#id_lista_articulos").val('');

		    $('#table_articulos tbody tr').each(function () {	 
		    articulo_id = $(this).find("td").eq(0).html();
		    descripcion = $(this).find("td").eq(1).html();

		    listado += articulo_id + "|" + descripcion + "&&&";
		    });

		      return listado;
	    }


	</script>

@endpush