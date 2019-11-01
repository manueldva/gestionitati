
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
			     

			      <h3 class="box-title">datos de la asignacion:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('codigo', 'Codigo Asignacion') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly']) }}
					</div>

			    	<div class="form-group">
						{{ form::label('empleado_id', 'Vendedor') }}
						{{ form::text('empleado_id', $stockasignacion->empleado->empleado, ['class' => 'form-control', 'id' => 'empleado_id', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('fecha', 'Fecha') }}
						{{ form::date('fecha', null, ['class' => 'form-control', 'id' => 'fecha', 'readonly']) }}
					</div>
			      	<div class="form-group">
			      		{{ form::label('observacion', 'Observacion') }}
						{{ form::textarea('observacion', null, ['class' => 'form-control', 'id'=>'observacion', 'rows' => 5, 'cols' => 40, 'maxlength' =>'100', 'readonly']) }}
			      	</div>
					<div class="form-group">
			      		{{ form::label('estado', 'Estado') }}
						{{ form::select('estado', ['1' => 'En Reparticion', '2' => 'Procesado'], null, ['class' => 'form-control'] ) }}
			      	</div>
					@if($show == 1)
					<hr>
					<br>	
					<div class="form-group">
					  <h3 class="box-title">Impresion Comprobantes:</h3>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_stocks" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> <center>Descripción</center></th>
											<th> <center>Acccion</center></th>
						
										</tr>
									</thead>
									<tbody>
										@isset($cargas)
											@foreach ($cargas as $carga)
							                  <tr>
							                    <td><center>Carga Nro {{ $carga->carga }}</center></td>
												<td><center>
													<a  href="{{ asset('printstocksignacion/') . '/' . $stockasignacion->id . '/' . $carga->carga }}" target="blank_" class='btn btn-sm btn-success' title="Imprimir Hoja de Ruta">
														<span class='glyphicon glyphicon-print'></span>
													</a></center>
												</td>
							                  </tr>
							                @endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
					@endif
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			      <h3 class="box-title">Stock Asignado:</h3>
			    </div>
			    <!-- /.box-header -->
				    <div class="box-body">
						<div class="form-group">
							{{ form::label('sucursal_id', 'Sucursal') }}
							{{ form::text('sucursal_id', $stockasignacion->empleado->sucursal->descripcion, ['class' => 'form-control', 'id' => 'sucursal_id', 'readonly']) }}
						</div>
					</div>
					<div class="box-body">
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
						</div>	
							
					</div>
					<hr>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_stocks" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Stock</th>
											<th> Retiro</th>
											<th> Dev. Carg.</th>
											<th> Dev. Vac.</th>
											<th> Contrato</th>
											<th> Recuperado</th>
											<th style="display:none;"> stockventa</th>
										</tr>
									</thead>
									<tbody>
										@isset($stockasignaciondetalles)
											@foreach ($stockasignaciondetalles as $stockasignaciondetalle)
							                  <tr>
							                    <td style="display:none;">{{ $stockasignaciondetalle->id }}</td>
							                    <td>{{ $stockasignaciondetalle->stockventa->stockarticulo->descripcion }}</td>
							                    <td>{{ $stockasignaciondetalle->cantidad }}</td>
							                    @if($show == 1)
							                     	<td>{{ $stockasignaciondetalle->devuelve }}</td>
							                     @else
							                    	<td><div class="number-field" contenteditable="true"><font color="black">{{ $stockasignaciondetalle->devuelve }}</font></div></td>
							                    @endif
							                    @if($show == 1)
							                     	<td>{{ $stockasignaciondetalle->vacios }}</td>
							                     @else
							                    	<td><div class="number-field" contenteditable="true"><font color="black">{{ $stockasignaciondetalle->vacios }}</font></div></td>
							                    @endif
							                    @if($show == 1)
							                     	<td>{{ $stockasignaciondetalle->vacioscierrecontrato }}</td>
							                     @else
							                    	<td><div class="number-field" contenteditable="true"><font color="black">{{ $stockasignaciondetalle->contrato }}</font></div></td>
							                    @endif
												@if($show == 1)
							                     	<td>{{ $stockasignaciondetalle->vacioscierrecontrato }}</td>
							                     @else
							                    	<td><div class="number-field" contenteditable="true"><font color="black">{{ $stockasignaciondetalle->vacioscierrecontrato }}</font></div></td>
							                    @endif
												<td style="display:none;">{{ $stockasignaciondetalle->stockventa_id }}</td>
							                  </tr>
							                @endforeach
										@endif
									</tbody>
								</table>
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

		$.get('{{ url("/") }}/api/stockarticulos?sucursal_id=' + 1,function(data) {

			$('#stock').empty();
			$('#stock').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

			$.each(data, function(fetch, stock){
				console.log(data);
				$('#stock').append('<option value="'+ stock.id +'">'+ stock.descripcion +'</option>');
			})
		});

		//buscador articulos
		function buscarstocks(stock_id) {

		//alert(articulo_id);

			if (stock_id !== '') {
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


		
		
		$( "#agregarstock" ).click(function() {
			
			tipostock = $('select[name="stock"] option:selected').val();

			if(tipostock == 0){
	   			toastr.error('Debe selecionar una opcion del combo');
	   			return false;
	   		}

			cantidadstock = $('#cantidadstock').val();
			stockactual = $('#stockactual').val();
			
			
			if(parseInt($("#cantidadstock").val()) < 1) {


				toastr.error('La cantidad ingresada no puede ser menor a 1');
				return false;
			}

	   		if(parseInt($("#cantidadstock").val()) > parseInt($("#stockactual").val())) {


				toastr.error('La cantidad ingresada no puede ser mayor al stock actual');
				return false;
			}
			

			$('#table_stocks tbody tr').each(function () {	 

			    cantidad = $(this).find("td").eq(2).text();
				codigo = $(this).find("td").eq(7).text();
			
				if(codigo == tipostock){
					suma = Math.round(cantidad) + Math.round(cantidadstock);
					$(this).find("td").eq(2).text(suma);
					toastr.success('Cantidad agregada');
					
				}

				$('#cantidadstock').val('');
				$('#stock_id').val('');
				buscarstocks($('#stock_id').val());
				
		    });



			//alert(cantidadstock);   


		});
		


		$( "#guardar" ).click(function() {


		   // listado de articulos
		    var listado = crear_listado_stocks();
      		$('#id_lista_stocks').val(listado);

      		if($('#id_lista_stocks').val() == ''){
      			toastr.error('Ocurrio un error, verifique los campos del listado');
      			return false;
      		} else {
      			swal({ 
					title: "Una vez procesada esta asignacion no podra modificarla",
					text: "¿Desea Guardarla?",
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


		    var temp = 0;
		    $('#table_stocks tbody tr').each(function () {	 
			    codigo = $(this).find("td").eq(0).html();
			    cantidad = $(this).find("td").eq(2).text();
			    devuelve =  $(this).find("td").eq(3).text();
			    vacios =  $(this).find("td").eq(4).text();
				contrato =  $(this).find("td").eq(5).text();
				vacioscierre =  $(this).find("td").eq(6).text();

				
			    if(!$.isNumeric(devuelve)) {
			    	temp = 1;
			    } else if(devuelve < 0) {
			    	temp = 1;
			    } else if(parseInt(devuelve) > parseInt(cantidad) ) {
			    	temp = 1;
			    }
			    listado += codigo + "|" + cantidad + "|" + devuelve + "|" + vacios + "|" + contrato + "|" + vacioscierre + "&&&";

		    });

			if(temp == 1){
				listado = '';
			}

			//alert(listado);
		    return listado;
	    }


	</script>

@endpush