
<input type="hidden" name="listado_stocks" id="id_lista_stocks">
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
			     

			      <h3 class="box-title">Ingresar los datos de la asignacion:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">

			    	<div class="form-group">
						{{ form::label('empleado_id', 'Vendedor *') }}
						{{ form::select('empleado_id',  $empleados, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
						<div id="empleado_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<div class="form-group">
						{{ form::label('fecha', 'Fecha *') }}
						{{ form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
						<div id="fechaspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
			      	
			      	<div class="form-group">
			      		{{ form::label('observacion', 'Observacion') }}
						{{ form::textarea('observacion', null, ['class' => 'form-control', 'id'=>'observacion', 'rows' => 5, 'cols' => 40, 'maxlength' =>'100']) }}
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
			      

			      <h3 class="box-title">Asignar Stock:</h3>
			    </div>
			    <!-- /.box-header -->
				    <div class="box-body">
						<div class="form-group">
							{{ form::label('sucursal_id', 'Sucursal *') }}
							{{ form::select('sucursal_id',  $sucursales, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...']) }} 
							<div id="sucursal_idspan" class="form-group has-error" style="display: none">
								<span class="help-block">Campo Obligatorio</span>
							</div>
						</div>
					</div>
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>	
									<td class="col-md-3"> 
										{{ form::label('stock_id', 'Cod.') }}
										{{ form::number('stock_id', null, ['class' => 'form-control', 'id' => 'stock_id']) }}
									</td>
									<td>
										{{ form::label('stock', 'Stock Articulo') }}
										<br>
										{{ form::select('stock', [],  null, ['class' => 'form-control inline-search', 'id' => 'stock','placeholder' => 'Seleccionar...'] ) }}
									</td>
								</tr>
								<tr>
									<td > 
										{{ form::label('stockactual', 'Stock Actual') }}
										{{ form::number('stockactual', null, ['class' => 'form-control', 'id' => 'stockactual', 'readonly']) }}
									</td>
									<td> 
										{{ form::label('cantidadstock', 'Cantidad') }}
										{{ form::number('cantidadstock', null, ['class' => 'form-control', 'id' => 'cantidadstock']) }}
									</td>
									<td> 
										<br>
										<a type="button" id="agregarstock" name="agregarstock" class="btn btn btn-success">
						                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
						                    <span class="fa fa-plus-circle">
						                    </span>
						                      AGREGAR
						                  </a>
									</td>
								</tr>
								<tr>

								</tr>
								
							</thead>
						</table>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_stocks" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Stock</th>
											<th> Cantidad</th>
											<th> </th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div id="table_stockspan" class="form-group has-error" style="display: none">
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


			estadocampos = 0;

			if ($('#empleado_id').val() == ''){
      			estadocampos = 1;
			   	$('#empleado_idspan').show();
      		} else {
      			$('#empleado_idspan').hide();
      		}
      		if ($('#sucursal_id').val() == ''){
      			estadocampos = 1;
			   	$('#sucursal_idspan').show();
      		} else {
      			$('#sucursal_idspan').hide();
      		}

      		if ($('#fecha').val() == ''){
      			estadocampos = 1;
			   	$('#fechaspan').show();
      		} else {
      			$('#fechaspan').hide();
      		}



		   // listado de articulos
		    var listado = crear_listado_stocks();
      		$('#id_lista_stocks').val(listado);

      		if ($('#id_lista_stocks').val() == ''){
      			estadocampos = 1;
			   	$('#table_stockspan').show();
      		} else {
      			$('#table_stockspan').hide();
      		}

      		
      		if(estadocampos == 1) 
      		{
      			toastr.error('No se puede guardar el stock. Faltan datos');
      			return false;
      		} else {
      			swal({ 
					title: "Una vez generada esta asignacion no podra modificar los movimientos de stock",
					text: "¿Desea Guardarlo?",
					type: "info",
					showCancelButton: true,
					//confirmButtonColor: "#DD6B55",
					confirmButtonText: "Guardar",
					cancelButtonText: "Cancelar", 
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){ 
					if (isConfirm) {
						$('#form').submit();
					} else { 
						swal.close()
					} 
				});
      			
      		}


		   	//$('#form').submit();

		});

		function crear_listado_stocks() {
		    var listado = '';
		    

		    $("#id_lista_stocks").val('');

		    $('#table_stocks tbody tr').each(function () {	 
		    codigo = $(this).find("td").eq(0).html();
		    cantidad = $(this).find("td").eq(2).html();

		    listado += codigo + "|" + cantidad + "&&&";
		    });

		      return listado;
	    }


	</script>

@endpush