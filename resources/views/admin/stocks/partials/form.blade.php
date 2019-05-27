
<input type="hidden" name="listado_articulos" id="id_lista_articulos">
<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-user"></i>

	      <h3 class="box-title">
	      	
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Ingresar los datos del Stock:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>	
										<td> 
											{{ form::label('stockminimo', 'Stock Minimo *') }}
											{{ form::number('stockminimo', null, ['class' => 'form-control', 'id' => 'stockminimo']) }}
											<div id="stockminimospan" class="form-group has-error" style="display: none">
												<span class="help-block">Campo Obligatorio</span>
											</div>
										</td>
										<td>
											{{ form::label('stockmaximo', 'Stock Maximo') }}
											{{ form::number('stockmaximo', null, ['class' => 'form-control', 'id' => 'stockmaximo']) }}
										</td>
									</tr>
									<tr>	
										<td> 
											{{ form::label('tiemporeposicion', 'Tiempo de Reposición') }}
											{{ form::number('tiemporeposicion', null, ['class' => 'form-control', 'id' => 'tiemporeposicion']) }}
										</td>
										<td>
											{{ form::label('tipotiempo_id', 'Tipo Tiempo') }}
											{{ form::select('tipotiempo_id',  $tipotiempos, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
										</td>
									</tr>
								</thead>
							</table>
						</div>
					</div>

				   	<div class="form-group">
						{{ form::label('sucursal_id', 'Sucursal *') }}
						{{ form::select('sucursal_id', $sucursales, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
						<div id="sucursal_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
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
										{{ form::select('articulo', $articulos,  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
									</td>
									<td> 
										<br>
										<a type="button" id="agregararticulo" name="agregararticulo" class="btn btn btn-success">
						                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
						                    <span class="fa fa-plus-circle">
						                    </span>
						                      AGREGAR
						                  </a>
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
									                   <a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'>
									                   	<span class='glyphicon glyphicon-trash'></span>
									                   </a>
								               	    </td>
							                   
							                  </tr>
							                @endforeach
										@endif
									</tbody>
								</table>
								<div id="table_articulosspan" class="form-group has-error" style="display: none">
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