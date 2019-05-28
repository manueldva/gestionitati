
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
			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Datos del Stock:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>	
										<td>
											{{ form::label('stockactual', 'Stock Actual') }}
											{{ form::number('stockactual', null, ['class' => 'form-control', 'id' => 'stockactual', 'readonly']) }}
										</td>
										<td> 
											{{ form::label('stockminimo', 'Stock Minimo *') }}
											{{ form::number('stockminimo', null, ['class' => 'form-control', 'id' => 'stockminimo', 'readonly']) }}
											
										</td>
									</tr>
								</thead>
							</table>
						</div>
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
							
							<div class="form-group">
								<div class="table-responsive">
									<table   id="table_articulos" class="table table-striped table-hover" data-form="Form">
										<thead>
											<tr>
											<!--<th width="10px"> ID</th>-->
												<th><center> Codigo</center></th>
												<th> <center>Articulo</center></th>
												
											</tr>
										</thead>
										<tbody>
											@isset($stockdetalles)
												@foreach ($stockdetalles as $stockdetalle)
								                  <tr>
								                    <td><center>{{ $stockdetalle->articulo_id }}</center></td>
								                    <td><center>{{ $stockdetalle->articulo->descripcion }}</center></td>
									                    
								                  </tr>
								                @endforeach
											@endif
										</tbody>
									</table>
									
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
	      	Ajuste
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title"></h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('tipoajuste_id', 'Tipo Ajuste *') }}
						{{ form::select('tipoajuste_id',  [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
					</div>
					<div class="form-group">
						{{ form::label('cantidad', 'Cantidad *') }}
						{{ form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']) }}
					</div>
					<div class="form-group">
						{{ form::label('motivoajuste_id', 'Motivo Ajuste *') }}
						{{ form::select('motivoajuste_id',  [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title"></h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
			    		{{ form::label('proveedorajuste_id', 'Proveedor') }}
						{{ form::select('proveedorajuste_id',  [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
						
					</div>
					<div class="form-group">
						{{ form::label('lote', 'Lote') }}
						{{ form::number('lote', null, ['class' => 'form-control', 'id' => 'lote']) }}
					</div>
					<div class="form-group">
						{{ form::label('fechavencimiento', 'Vencimiento') }}
						{{ form::number('fechavencimiento', null, ['class' => 'form-control', 'id' => 'fechavencimiento']) }}
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<div class="form-group">
				{{ form::label('observacion', 'Observacion') }}
				{{ form::textarea('observacion', null, ['class' => 'form-control', 'id' => 'observacion']) }}
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
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
		$( "#agregararticulo" ).click(function() {

			if($('#sucursal_id').val() == '') {


				toastr.error('Debe seleccionar una sucursal para dar de alta los articulos');
				return false;
			}


			if($('#articulo_id').val() == '') {


				toastr.error('No se puede agregar este articulo. Faltan datos');
				return false;
			}

			if ($('#articulo_id').val() !== '') {
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/stockarticulodetalles',
					async: false,
					//url: '../api/validardocumento',
					data: {q: $('#articulo_id').val(), s: $('#sucursal_id').val()}
				}).done(function(data) {
					//var $empleado = $('#empleado'); 
					if(data !== 0) {
						
						toastr.error('Este articulo ya existe en otro stock');
						return false;
					} else {
									//variables para guardar en la grilla
						var codigo = $('#articulo_id').val();
						//var descripcion = $("#descripcionarticulo").val();
						var descripcion =$('select[name="articulo"] option:selected').text();


						//cargo la grilla
						$('#table_articulos tbody').prepend(
							'<tr>' + 
							'<td style="display:none;">' + codigo + '</td>' +
							'<td>' + descripcion + '</td>' +
							"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
							'</td>' +
							'</tr>');

							/*$("#articulo_id").val('');
							$("#articulo").val('');
							$("#cantidadarticulo").val('');*/
						
						buscarArticulos(0);

						toastr.success('Articulo agregado a la lista');
					}
					
				});
			}

			
			

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