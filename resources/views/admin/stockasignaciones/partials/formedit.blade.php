
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
								<table   id="table_temp" class="table table-striped table-hover" data-form="Form">
									<tbody>
										<tr>
											<td>
												{{ form::label('stock', 'Stock') }}
													<select id="stock_id" name="stock_id" class="form-control">
													<option value='0' selected>Seleccionar</option>
													@isset($stockasignaciondetalles)
														@foreach ($stockasignaciondetalles as $stockasignaciondetalle)
															<option value="{{ $stockasignaciondetalle->id }}">{{ $stockasignaciondetalle->stockventa->stockarticulo->descripcion }}</option>
														@endforeach
													@endif
											</td>
											<td> 
												{{ form::label('sumarcantidad', 'Cantidad a Sumar') }}
												{{ form::number('sumarcantidad', null, ['class' => 'form-control', 'id' => 'sumarcantidad']) }}
											</td>
											<td> 
												<br>
												<a type="button" id="agregarcantidad" name="agregarcantidad" class="btn btn btn-success">
													<span class="fa fa-plus-circle">
													</span>
													AGREGAR
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
		
		
		$( "#agregarcantidad" ).click(function() {
			
			tipostock = $('select[name="stock_id"] option:selected').val();

			if(tipostock == 0){
	   			toastr.error('Debe selecionar una opcion del combo');
	   			return false;
	   		}

			sumarcantidad = $('#sumarcantidad').val();
			
			
			if(sumarcantidad < 1){
	   			toastr.error('La cantidad a sumar es incorrecta');
	   			return false;
	   		}
			

			$('#table_stocks tbody tr').each(function () {	 

				codigo = $(this).find("td").eq(0).text();
			    cantidad = $(this).find("td").eq(2).text();

				if(codigo == tipostock){
					suma = Math.round(cantidad) + Math.round(sumarcantidad);
					$(this).find("td").eq(2).text(suma);
					toastr.success('Cantidad agregada');
				}

				$('#sumarcantidad').val('');
				$('#stock_id').val('0');
				
		    });



			//alert(sumarcantidad);   


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