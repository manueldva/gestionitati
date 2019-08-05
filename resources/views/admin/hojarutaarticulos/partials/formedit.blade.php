
<input type="hidden" name="listado_hoja" id="id_lista_hojarutas">
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
			     

			      <h3 class="box-title">Datos de la Hoja:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('codigo', 'Codigo Hoja Ruta') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly']) }}
					</div>

			    	<div class="form-group">
						{{ form::label('empleado_id', 'Vendedor') }}
						{{ form::text('empleado_id', $hojaruta->empleado->empleado, ['class' => 'form-control', 'id' => 'empleado_id', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('fecha', 'Fecha') }}
						{{ form::date('fecha', null, ['class' => 'form-control', 'id' => 'fecha', 'readonly']) }}
					</div>
			      	<div class="form-group">
			      		{{ form::label('estado', 'Estado') }}
						{{ form::select('estado', ['1' => 'En Reparticion', '2' => 'Procesado'], null, ['class' => 'form-control'] ) }}
			      	</div>
			      	<div class="form-group">
						{{ form::label('cliente_id', 'Nro Socio *') }}
						{{ form::number('cliente_id',null, ['class' => 'form-control', 'id' => 'cliente_id']) }}
					</div>
					<div class="form-group">
						<a type="button" id="buscarcliente" name="buscarcliente" class="btn btn btn-primary">
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
			      

			      <h3 class="box-title">Detalle Cliente:</h3>
			    </div>
			    <!-- /.box-header -->
				    <div class="box-body">
				    	<div style="display:none" class="form-group">
							{{ form::label('cliente_id2', 'Cliente') }}
							{{ form::text('cliente_id2',null, ['class' => 'form-control', 'id' => 'cliente_id2']) }}
						</div>
				    	<div class="form-group">
							{{ form::label('fechacarga', 'Fecha Carga *') }}
							{{ form::date('fechacarga', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechacarga']) }}
						</div>
				    	<div class="form-group">
							{{ form::label('cliente', 'Cliente') }}
							{{ form::text('cliente',null, ['class' => 'form-control', 'id' => 'cliente', 'readonly']) }}
						</div>
						<div class="form-group">
							{{ form::label('direccion', 'Direccion') }}
							{{ form::text('direccion',null, ['class' => 'form-control', 'id' => 'direccion', 'readonly']) }}
						</div>
					</div>
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>	
										<td>
											{{ form::label('articulo', 'Agregar Articulos') }}
											<br>
											{{ form::select('articulo', $articulos,  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
										</td>
										<td> 
											<br>
											<a type="button" id="agregararticulo1" name="agregararticulo1" class="btn btn btn-success">
							                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
							                    <span class="fa fa-plus-circle">
							                    </span>
							                      
							                </a>
										</td>
									</tr>

									
								</thead>
							</table>
						</div>
					</div>
					<hr>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_clientes" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Articulo</th>
											<th> Cantidad</th>
											<th> Tipo Pago</th>
											<th style="display: none;"> Tipo Proceso</th>
											<th style="display: none;"> articulo_id</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<br>
					<a type="button" id="agregararticulo" name="agregararticulo" class="btn btn btn-success">
	                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
	                    <span class="fa fa-plus-circle">
	                    </span>
	                      AGREGAR
	                </a>
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
											Codigo
										</center>
									</th>
									<th style="display: none;">
										<center>
											Tipo Pago
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
											<i></i> Tipo Proceso
										</center>
									</th>
									<th style="display: none;">
										<center>
											<i></i> articulo_id
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
	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		var APP_RL = "{{ url('/') }}";

		$( "#buscarcliente" ).click(function() {

			$("#table_clientes").find("tr:gt(0)").remove();
			
			if ($('#cliente_id').val() !== '') {

				var temp = 0;
				$('#table_hojaruta tbody tr').each(function () {	 
				   codigo = $(this).find("center").eq(2).html();
				   
				   if(codigo == $('#cliente_id').val()){
				   		temp = 1;
				   }
   
			    });

				if(temp !== 1) {


					$.ajax({
						dataType: 'json',
						url: APP_URL + '/api/detalleclientehojaruta',
						//async: false,
						//url: '../api/validardocumento',
						data: {cli: $('#cliente_id').val(), hoj: $('#id').val()}
					}).done(function(data) {
						//var $empleado = $('#empleado'); 
						if(data == 0) {
							$('#cliente').val('');
							$("#direccion").val('');
							$("#cliente_id2").val('');
							toastr.error('Este Cliente ya se encuentra en la listado o fue procesado anteriormente');
							return false;
						} else if(data == 1) {
							$('#cliente').val('');
							$("#direccion").val('');
							$("#cliente_id2").val('');
							toastr.info('Este cliente no tiene articulos en el contrato que puedan ser cargados en esta hoja de ruta');
							return false;
						} else {
			
							//variables para guardar en la grilla

							var tipoprocesotemp = 0;
							$.each(data, function(key, value){
								$('#cliente').val(value.cliente);
								tipoproceso = value.tipoproceso;
								var direccion = '';
								if(value.tipoproceso == 0) {
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

								}
								
								if(value.clasificacion == 0){
									var clasificacion = '<center><select id="select" class="form-control">'+
						            '<option value="1" selected>Efectivo</option>' +
						            '<option value="2">Cuenta C.</option>' +
						          	'</select></center>';
								} else {
									var clasificacion = '<center><select id="select" class="form-control">'+
						            '<option value="0" selected>Sin Cargo</option>' +
						          	'</select></center>';
								}


								$("#direccion").val(direccion);
								$("#cliente_id2").val($("#cliente_id").val());
								if(value.tipoproceso !== 2){
									$('#table_clientes tbody').prepend(
									'<tr>' + 
									'<td style="display: none;"><center>' + value.id + '</center></td>' +
									'<td><center>' + value.articulo + '</center></td>' +
			 						'<td><center><div contenteditable="true"><font color="green">'+value.cantidad+'</font></div></td>' +
			 						'<td>' + clasificacion + '</td>' +
			 						'<td style="display: none;">' + value.tipoproceso + '</td>' +
			 						'<td style="display: none;">' + value.articulo_id + '</td>' +
			 						"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
									
									'</tr>');
								}
					    	})	

					    	if(tipoproceso == 1){
					    		toastr.info('Este cliente no se encuentra en la hoja de ruta');		
					    	}						
						}
						
					});
				}else {
					toastr.info('Este cliente ya se encuentra en el listado final');					
					return false;
				}
			} else {
				$('#cliente').val('');
				$("#direccion").val('');
				$("#cliente_id2").val('');
			}

			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Registro eliminado de la lista');
		}


		$(document).ready(function(){
			$("#cliente_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
				var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					$('#buscarcliente').click();
				}
			});
		});
		/*
		$('#cliente_id').focusout(function(e) {

			$('#buscarcliente').click();
		});*/
	

			/*para agregar articulos al listado parcial*/
		$("#agregararticulo1").click(function() {
			
			if($('#articulo').val() == ''){
				toastr.error('No selecciono ningun articulo');
				return false;
			}

			if($('#cliente_id2').val() == ''){
				toastr.error('Faltan datos del cliente');
				return false;
			}

			var temp = 0;
			$('#table_clientes tbody tr').each(function () {	 
			   codigo = $(this).find("td").eq(5).html();
			   
			   if(codigo == $('#articulo').val()){
			   		temp = 1;
			   }

		    });


			if(temp == 1){
				toastr.error('Este articulo ya se encuentra en el listado parcial');
				return false;
			}

			var clasificacion = '<center><select id="select" class="form-control">'+
						            '<option value="1" selected>Efectivo</option>' +
						            '<option value="2">Cuenta C.</option>' +
						            '<option value="0">Sin Cargo</option>' +
						          	'</select></center>';


			$('#table_clientes tbody').prepend(
			'<tr>' + 
			'<td style="display: none;"><center>' + 0 + '</center></td>' +
			'<td><center>' + $('select[name="articulo"] option:selected').text() + '</center></td>' +
				'<td><center><div contenteditable="true"><font color="green">'+ 1 +'</font></div></td>' +
				'<td>' + clasificacion + '</td>' +
				'<td style="display: none;">' + 1 + '</td>' +
				'<td style="display: none;">' + $('#articulo').val() + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
			
			'</tr>');

			toastr.success('Articulo agreado al listao parcial');
		});


		/*para agregar articulos al listado*/
		$( "#agregararticulo" ).click(function() {

			
			var cantidad = $('#table_clientes >tbody >tr').length;
			
			if(cantidad < 1){
				toastr.error('No tiene articulos en el listado');
				return false;
			}


			listado_cliente();
			

		});



		$( "#guardar" ).click(function() {


			
		   // listado de articulos
		    var listado = crear_listado_hojas();
      		$('#id_lista_hojarutas').val(listado);

      		//alert(listado);

      		if($('#id_lista_hojarutas').val() == ''){
      			toastr.error('Ocurrio un error, verifique los campos del listado final');
      			return false;
      		} else {
      			//alert($('#id_lista_stocks').val());
      			$('#form').submit();
      		}
      		
      		
      	


		   	//$('#form').submit();

		});

		

	    function listado_cliente() {
		    var listado = '';

		    var temp = 0;
		    $('#table_clientes tbody tr').each(function () {	 
			    codigo = $(this).find("center").eq(0).html();
			    cantidad = $(this).find("center").eq(2).text();
			    tipopago =  $(this).find("select").val();

			    if(!$.isNumeric(cantidad)) {
			    	temp = 1;
			    } else if(cantidad < 0) {
			    	temp = 1;
			    }
			    listado += codigo + "|" + cantidad + "|" + tipopago + "&&&";
		    });

			if(temp == 1){
				toastr.error('Ocurrio un error, verifique los campos del listado');
      			return false;
			} else {
				$('#table_clientes tbody tr').each(function () {	 
				    codigo = $(this).find("center").eq(0).html();
				    articulo = $(this).find("center").eq(1).html();
				    cantidad = $(this).find("center").eq(2).text();
				    tipopago =  $(this).find("select").val();
 					tipoproceso = $(this).find("td").eq(4).html();
 					articulo_id = $(this).find("td").eq(5).html();
				    $('#table_hojaruta tbody').prepend(
						'<tr>' + 
						'<td style="display: none;"><center>' + codigo + '</center></td>' +
						'<td style="display: none;"><center>' + tipopago + '</center></td>' +
						'<td><center>'  + $('#cliente_id2').val() +  '</center></td>' +
						'<td><center>' + $('#cliente').val() + '</center></td>' +
						'<td><center>' + $('#direccion').val() + '</center></td>' +
						'<td><center>' + articulo + '</center></td>' +
						'<td><center>' + cantidad + '</center></td>' +
						'<td style="display: none;"><center>' + tipoproceso + '</center></td>' +
						'<td style="display: none;"><center>' + articulo_id + '</center></td>' +
						"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo2_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
						'</tr>');
			    });

			    $('#cliente').val('');
				$("#direccion").val('');
				$("#cliente_id2").val('');
				$("#cliente_id").val('');
				$("#table_clientes").find("tr:gt(0)").remove();
				toastr.success('Cliente cargado al listado');
			}
	    }

	    function deletearticulo2_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Registro eliminado de la lista');
		}

	    function crear_listado_hojas() {
		    var listado = '';
		    

		    //$("#id_lista_stocks").val('');

		    var temp = 0;
		    $('#table_hojaruta tbody tr').each(function () {	 
			    codigo = $(this).find("center").eq(0).html();
			    tipopago = $(this).find("center").eq(1).html();
			    cliente_id =  $(this).find("center").eq(2).html();
			    cantidad =  $(this).find("center").eq(6).html();
			    tipoproceso =  $(this).find("center").eq(7).html();
			    articulo_id =  $(this).find("center").eq(8).html();



			    listado += codigo + "|" + tipopago + "|" + cantidad + "|" + tipoproceso + "|" + cliente_id + "|" + articulo_id + "&&&";
		    });

			//alert(listado);
		    return listado;
	    }


	</script>

@endpush