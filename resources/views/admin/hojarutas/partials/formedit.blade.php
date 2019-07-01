
<input type="hidden" name="listado_stocks" id="id_lista_hojarutas">
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
				    	<div class="form-group">
							{{ form::label('cliente', 'Cliente') }}
							{{ form::text('cliente',null, ['class' => 'form-control', 'id' => 'cliente', 'readonly']) }}
						</div>
						<div class="form-group">
							{{ form::label('direccion', 'Direccion') }}
							{{ form::text('direccion',null, ['class' => 'form-control', 'id' => 'direccion', 'readonly']) }}
						</div>
					</div>
					<hr>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_clientes" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Articulo</th>
											<th> Cantidad</th>
											<th> Tipo Pago</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
										<br>
					<a type="button" id="agregarstock" name="agregarstock" class="btn btn btn-success">
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

	
	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		var APP_RL = "{{ url('/') }}";





		$(document).ready(function(){
			$("#cliente_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
			var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					if ($('#cliente_id').val() !== '') {
						$.ajax({
							dataType: 'json',
							url: APP_URL + '/api/detalleclientehojaruta',
							//async: false,
							//url: '../api/validardocumento',
							data: {cli: $('#cliente_id').val(), hoj: $('#id').val()}
						}).done(function(data) {
							//var $empleado = $('#empleado'); 
							if(data == 0) {
								
								toastr.error('Este Cliente ya no posee articulos que registrar');
								return false;
							} else {
											//variables para guardar en la grilla
								$.each(data, function(key, value){
									$('#cliente').val(value.cliente);

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

									$("#direccion").val(direccion);
									$('#table_clientes tbody').prepend(
									'<tr>' + 
									'<td style="display: none;"><center>' + value.id + '</center></td>' +
									'<td><center>' + value.articulo + '</center></td>' +
			 						'<td><center><div contenteditable="true"><font color="green">'+value.cantidad+'</font></div></td>' +
			 						'<td><center>0</center></td>' +
									'</tr>');
						    	})							}
							
						});
					}

				}
			});
		});


		$('#sucursal_id').on('change', function(e){

			console.log(e);
		    var sucursal_id = e.target.value;
			$.get('{{ url("/") }}/api/stockarticulos?sucursal_id=' + sucursal_id,function(data) {

			  	$('#stock').empty();
			  	$('#stock').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

		      	$.each(data, function(fetch, stock){
		        	console.log(data);
		        	$('#stock').append('<option value="'+ stock.id +'">'+ stock.descripcion +'</option>');
		      	})
		    });
			
			
		});

		//buscador articulos
		function buscarstocks(stock_id) {

			//alert(articulo_id);

			if ($('#sucursal_id').val() !== ''  &&  stock_id !== '') {
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/stockarticulo',
				//url: '../api/validardocumento',
				data: {q: stock_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data !== 0) {
					$("#stock_id").val(data.id);
					$("#stock").val(data.id);
					$("#stockactual").val(data.stockactual);
					$("#cantidadstock").val(1);

					//$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
					//toastr.info('Codigo de vendedor correcto');
				} else{
					$("#stock_id").val('');
					$("#stock").val('');
					$("#stockactual").val('');
					$("#cantidadstock").val('');
					
				}
				
			});
			} else {
				$("#stock_id").val('');
				$("#stock").val('');
				$("#stockactual").val('');
				$("#cantidadstock").val('');
			}
		}


		$('#stock_id').focusout(function(e) {

			buscarstocks($('#stock_id').val());

		});

		$(document).ready(function(){
			$("#stock_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
			var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					if ($('#stock_id').val() == '') $('#stock').val(''); 
					buscarstocks($('#stock_id').val());

				}
			});
		});

		$('#stock').on('change', function(e){
			if ($('#stock').val() == '') $('#stock_id').val(''); 
			buscarstocks($('#stock').val());
		});


		/*para agregar articulos al listado*/
		$( "#agregarstock" ).click(function() {

			
			if($('#stock_id').val() == ''  || $("#cantidadstock").val() == '') {


				toastr.error('No se puede agregar este stock. Faltan datos');
				return false;
			}

			if(parseInt($("#cantidadstock").val()) < 1) {


				toastr.error('La cantidad ingresada no puede ser menor a 1');
				return false;
			}

			if(parseInt($("#cantidadstock").val()) > parseInt($("#stockactual").val())) {


				toastr.error('La cantidad ingresada no puede ser mayor al stock actual');
				return false;
			}

			//variables para guardar en la grilla
			var codigo = $('#stock_id').val();

			var existe = 0;
			$('#table_stocks tbody tr').each(function () {	 
		    	temp = $(this).find("td").eq(0).html();
		   		if(temp == codigo){
		   			existe = 1;
		   		}	
		    });

		    if(existe == 1){
	   			toastr.error('Este stock ya se encuentra en la lista');
	   			return false;
	   		}

			//var descripcion = $("#descripcionarticulo").val();
			var descripcion =$('select[name="stock"] option:selected').text();
			var cantidad = parseInt($('#cantidadstock').val());



			//cargo la grilla
			$('#table_stocks tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletestock_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

				/*$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');*/
			
			buscarstocks(0);

			toastr.success('Stock agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletestock_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Stock eliminado de la lista');
		}

		
		



		$( "#guardar" ).click(function() {


			

		   // listado de articulos
		    var listado = crear_listado_stocks();
      		$('#id_lista_stocks').val(listado);

      		if($('#id_lista_stocks').val() == ''){
      			toastr.error('Ocurrio un error, verifique los campos del listado');
      			return false;
      		} else {
      			//alert($('#id_lista_stocks').val());
      			$('#form').submit();
      		}
      		
      		
      	


		   	//$('#form').submit();

		});

		function crear_listado_stocks() {
		    var listado = '';
		    

		    $("#id_lista_stocks").val('');

		    var temp = 0;
		    $('#table_stocks tbody tr').each(function () {	 
			    codigo = $(this).find("td").eq(0).html();
			    cantidad = $(this).find("td").eq(2).html();
			    devuelve =  $(this).find("td").eq(3).text();

			    if(!$.isNumeric(devuelve)) {
			    	temp = 1;
			    } else if(devuelve < 0) {
			    	temp = 1;
			    }
			    listado += codigo + "|" + cantidad + "|" + devuelve + "&&&";
		    });

			if(temp == 1){
				listado = '';
			}

		    return listado;
	    }


	</script>

@endpush