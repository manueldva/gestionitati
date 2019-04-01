
<input type="hidden" name="listado_precios" id="id_lista_precios">
<input type="hidden" name="listado_planarticulos" id="id_lista_planarticulos">
<div class="row">
	<div class="col-md-12">	
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Ingrese</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
		      
				  	<div class="form-group">
					  	{{ form::label('id', 'Nro Producto') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly'=> 'readonly']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('tipoarticulo_id', 'Tipo de Producto *') }}
						{{ form::select('tipoarticulo_id', $tipoarticulos, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
						<div id="tipoarticulo_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('descripcion', 'Descripción *') }}
						{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion', 'placeholder'=> 'Descripción', 'maxlength' =>'300']) }}
						<div id="descripcionspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
				  	</div>
				  	
				  	<div class="form-group" id="envase">
					  	{{ form::label('tipoenvase_id', 'Tipo de Envase *') }}
						{{ form::select('tipoenvase_id', $tipoenvases, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
						<div id="tipoenvasespan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('caracteristicas', 'Carateristicas ') }}
						{{ form::text('caracteristicas', null, ['class' => 'form-control', 'id' => 'caracteristicas', 'placeholder'=> 'Caracteristicas', 'maxlength' =>'300']) }}
						
				  	</div>	
				  	<div class="form-group">
					  	{{ form::label('abreviatura', 'Abreviatura ') }}
						{{ form::text('abreviatura', null, ['class' => 'form-control', 'id' => 'abreviatura', 'placeholder'=> 'Abreviatura', 'maxlength' =>'50']) }}
						
				  	</div>	
				  	<div class="form-group" id="precio_plan">
					  	{{ form::label('precioplan', 'Precio *') }}
						{{ form::number('precioplan', null, ['class' => 'form-control', 'id' => 'precioplan']) }}
						<div id="precioplanspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
				  	</div>	
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-mobile-phone"></i>-->

			      <h3 class="box-title">Clasificación</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      	<div class="form-group">
						<label>
							<label>
								@if(isset($cuenta))
									@if($cuenta == 1)
										{{ Form::checkbox('cuentasi','1', true)}} Si
									@else 
										{{ Form::checkbox('cuentasi','1')}} Si	
									@endif
								@else 
									{{ Form::checkbox('cuentasi','1')}} Si
								@endif
								
							</label>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="pull-right">
							<label >
								@if(isset($cuenta))
									@if($cuenta == 0)
										{{ Form::checkbox('cuentano','1', true)}} No
									@else 
										{{ Form::checkbox('cuentano','1')}} No	
									@endif
								@else 
									{{ Form::checkbox('cuentano','1')}} No
								@endif
							</label>
						</label>
						
					</div>
					<hr>

					@if(! empty($articulo->file))
						<div class="form-group">
							<p> <strong>Seleccione una imagen:</strong></p>
						    <img src="{{ asset($articulo->file) }}" height="250" width="250" class="profile_img">
						</div>
						<div class="form-group">
							{{ form::label('eliminarimagen', 'Eliminar Logo') }}	
							<label>
								{{ Form::checkbox('eliminarimagen','on')}} 
							</label>
						</div>
					@else
						<div class="form-group" >
							<p> <strong>Seleccione una imagen:</strong></p>
						    <img src="{{ asset('imagedefeult/bidon_default.png') }}" height="230" width="250" class="profile_img">						    
						</div>

					@endif

					<hr>
					<div class="form-group">
						{{ Form::file('image') }}
					</div>

			      
			    </div>
			</div>

	 	</div>
	    <!-- /.box-body -->
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

<!--      segundo div general                              -->


	<div class="col-md-12" id ="panel_articulo_precios">	
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Ingrese un precio:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
		      
				  	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td> 
											{{ form::label('tipoprecio_id', 'Tipo Precio') }}
											{{ form::select('tipoprecio_id', $tipoprecios,  null, ['class' => 'form-control', 'id' => 'tipoprecio_id','placeholder' => 'Seleccionar...'] ) }}
										</td>
										<td> 
											{{ form::label('precio', 'Precio') }}
											{{ form::number('precio', null, ['class' => 'form-control', 'id' => 'precio']) }}
										</td>
										<td> 
											<br>
											<a type="button" id="agregarprecio" name="agregarprecio" class="btn btn btn-success">
							                    <span class="fa fa-plus-circle">
							                    </span>
							                    AGREGAR
							                </a>
										</td>
									</tr>		
								</thead>
							</table>
						</div>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_precios" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;">Codigo</th>
											<th> Tipo Precio</th>
											<th> Precio</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<div id="table_preciosspan" class="form-group has-error" style="display: none">
									<span class="help-block">Debe haber al menos un registro en la lista</span>
								</div>
							</div>
						</div>
						
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-mobile-phone"></i>-->

			      <h3 class="box-title">Otros impuestos:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      	<div class="form-group">
					  	{{ form::label('costo', 'Consto') }}
						{{ form::number('costo', null, ['class' => 'form-control', 'id' => 'costo']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('costovendedor', 'C. Vendedor') }}
						{{ form::number('costovendedor', null, ['class' => 'form-control', 'id' => 'costovendedor']) }} 
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('costorepartidor', 'C. Repartidor') }}
						{{ form::number('costorepartidor', null, ['class' => 'form-control', 'id' => 'costorepartidor']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('condicioniva', 'Con. IVA') }}
						{{ form::number('condicioniva', null, ['class' => 'form-control', 'id' => 'condicioniva']) }}
				  	</div>
			      
			    </div>
			</div>

	 	</div>
	    <!-- /.box-body -->
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
	 <!-- tercer div general -->

	

<!-- cuarta seccion-->

	<div class="col-md-12" id ="panel_articulo_planes">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">
	    	<div class="col-md-10">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Ingrese articulos al plan:</h3>
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
											{{ form::select('articulo', $planarticulos,  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
										</td>
										<td> 
											{{ form::label('cantidadarticulo', 'Cantidad') }}
											{{ form::number('cantidadarticulo', null, ['class' => 'form-control', 'id' => 'cantidadarticulo']) }}
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
									<table   id="table_planarticulos" class="table table-striped table-hover" data-form="Form">
										<thead>
											<tr>
											<!--<th width="10px"> ID</th>-->
												<th style="display:none;"> Codigo</th>
												<th> Articulo</th>
												<th> Cantidad</th>
												<th> </th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
									<div id="table_planarticulosspan" class="form-group has-error" style="display: none">
										<span class="help-block">Debe haber al menos un registro en la lista</span>
									</div>
								</div>
							</div>
						</div>
			    	</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			
	  </div>
	</div>
</div>
	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		/*mostrar campos dependiendo del tipo del articulo*/
		function habilitar_Planarticulos(){
			var tipoa = $('#tipoarticulo_id').val();

			if(tipoa == 2){
				$("#panel_articulo_planes").show();
				$("#panel_articulo_precios").show();
				$("#precio_plan").show();
				$("#envase").hide();
				$("#agregarprecio").hide();
			} else if (tipoa == 3){
				$("#panel_articulo_planes").hide();
				$("#panel_articulo_precios").hide();
				$("#precio_plan").hide();
				$("#envase").hide();
				$("#agregarprecio").hide();
			} else {
				$("#panel_articulo_planes").hide();
				$("#panel_articulo_precios").show();
				$("#precio_plan").hide();
				$("#envase").show();
				$("#agregarprecio").show();
			}

		}
		precio_plan

		habilitar_Planarticulos();

		$('#tipoarticulo_id').change(function(e) {
			
			habilitar_Planarticulos();
		});//


		
		//para usar en ves del input radio
		if(!$('input[name=cuentasi]:checkbox:checked').val() == '1' && !$('input[name=cuentano]:checkbox:checked').val() == '1') 	$('input[name=cuentano]').iCheck('check');

		$('input[name=cuentano]').on('ifChecked', function(event){

			$('input[name=cuentasi]').iCheck('uncheck');

		});

		$('input[name=cuentasi]').on('ifChecked', function(event){

			$('input[name=cuentano]').iCheck('uncheck');
						
			$("#limite").removeAttr("disabled");
			$("#limite").focus();
			

		});

		var APP_RL = "{{ url('/') }}";


		//buscador articulos
		function buscarArticulos(articulo_id) {

			//alert(articulo_id);

			if (articulo_id !== '') {
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/planarticulos',
				//url: '../api/validardocumento',
				data: {q: articulo_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data !== 0) {
					$("#articulo_id").val(data.id);
					$("#articulo").val(data.id);
					$("#cantidadarticulo").val(1);

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
			$('#table_planarticulos tbody tr').each(function () {	 
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
			$('#table_planarticulos tbody').prepend(
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


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}


		$('#tipoprecio_id').on('change', function(e){
		   $('#precio').focus();
		});


		/*para agregar precios al listado*/
		$( "#agregarprecio" ).click(function() {

			
			if($('#tipoprecio_id').val() == ''  || $("#precio").val() == '') {


				toastr.error('No se puede agregar este precio. Faltan datos');
				return false;
			}

			if(parseInt($("#precio").val()) < 1) {


				toastr.error('El precio ingresada no puede ser menor a 1');
				return false;
			}


			//variables para guardar en la grilla
			var codigo = $('#tipoprecio_id').val();
			//var descripcion = $("#descripcionarticulo").val();
			var descripcion =$('select[name="tipoprecio_id"] option:selected').text();
			var precio = parseFloat($('#precio').val());


			//validar que no se repita el mismo precio
			existeprecio = 0;
			$('#table_precios tbody tr').each(function () {	 
		    tipoprecio_idtemp = $(this).find("td").eq(0).html();
		    
		    	if(tipoprecio_idtemp == codigo) {
		    		
		    		existeprecio = 1;
		    	}
		    	
		    });

		    //alert(existeprecio);
		    if(existeprecio == 1){
		    	toastr.error('Este precio ya existe en la lista');
		    	return false;
		    }
			
			//
			//cargo la grilla
			$('#table_precios tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + precio + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deleteprecio_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

				$("#tipoprecio_id").val('');
				$("#precio").val('');

			toastr.success('Precio agregado a la lista');

	
			
		});


		/*borrar filas del listado de articulos*/
		function deleteprecio_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Precio eliminado de la lista');
		}

		
		$( "#guardar" ).click(function() {

			estadocampos = 0;
			//alert($('#tipoarticulo_id').val());
			if ($('#tipoarticulo_id').val() == ''){
      			estadocampos = 1;
			   	$('#tipoarticulo_idspan').show();
      		} else {
      			$('#tipoarticulo_idspan').hide();
      		}

			if ($('#descripcion').val() == ''){
      			estadocampos = 1;
			   	$('#descripcionspan').show();
      		} else {
      			$('#descripcionspan').hide();
      		}


			// listado de familiares
		    var listado = crear_listado_precios();
      		$('#id_lista_precios').val(listado);

      		 var listado2 = crear_listado_planarticulos();
      		$('#id_lista_planarticulos').val(listado2);

      		/*if ($('#id_lista_direcciones').val() == ''){

      		}*/
      		var tipoa = $('#tipoarticulo_id').val();

			if(tipoa == 1){
				if ($('#tipoenvase_id').val() == ''){
	      			estadocampos = 1;
				   	$('#tipoenvasespan').show();
	      		} else {
	      			$('#tipoenvasespan').hide();
	      		}
	      		if($('#id_lista_precios').val() == ''){
	      			estadocampos = 1;
				   	$('#table_preciosspan').show();
				} else {
					$('#table_preciosspan ').hide();
				}
			} else if (tipoa == 2){
				if ($('#precioplan').val() == ''){
	      			estadocampos = 1;
				   	$('#precioplanspan').show();
	      		} else {
	      			$('#precioplanspan').hide();
	      		}
	      		if($('#id_lista_planarticulos').val() == ''){
	      			estadocampos = 1;
				   	$('#table_planarticulosspan').show();
				} else {
					$('#table_planarticulosspan ').hide();
				}
			
			} 

			if(estadocampos == 1) 
      		{
      			toastr.error('No se puede guardar el contrato. Faltan datos');
      			return false;
      		} else {
      			$('#form').submit();
      		}

			//$('#form').submit();
		
		});



		function crear_listado_planarticulos() {
		    var listado = '';
		    var articulo_id, cantidad;

		    $("#id_lista_planarticulos").val('');

		    $('#table_planarticulos tbody tr').each(function () {	 
		    articulo_id = $(this).find("td").eq(0).html();
		    cantidad = $(this).find("td").eq(2).html();
		    

		    	listado += articulo_id + "|" + cantidad + "&&&";
		    });

		    return listado;
	    }

	    function crear_listado_precios() {
		    var listado = '';
		    var tipoprecio_id, precio;

		    $("#id_lista_precios").val('');

		    $('#table_precios tbody tr').each(function () {	 
		    tipoprecio_id = $(this).find("td").eq(0).html();
		    precio = $(this).find("td").eq(2).html();
		    

		    	listado += tipoprecio_id + "|" + precio + "&&&";
		    });

		    return listado;
	    }


	</script>

@endpush