
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

			<div class="col-md-6">
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
						{{ form::select('tipoajuste_id',  $tipoajustes, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
					</div>
					<div class="form-group">
						{{ form::label('cantidad', 'Cantidad *') }}
						{{ form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']) }}
					</div>
					<div class="form-group">
						{{ form::label('motivoajuste_id', 'Motivo Ajuste') }}
						{{ form::select('motivoajuste_id',  $motivoajustes, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
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
						{{ form::select('proveedorajuste_id',  $proveedorajustes, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
						
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
				{{ form::textarea('observacion', null, ['class' => 'form-control', 'id' => 'observacion', 'rows' => 3, 'cols' => 40, 'maxlength' =>'500']) }}
			</div>
			<br>
			<div class="form-group">

					<a type="label" class="form-control btn-primary" style="font-size:18px">
							<label id="total">
								Stock Total: {{ $stock->stockactual }}
							</label>
							
					</a>
				
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


		$( "#cantidad" ).keyup(function() {

		  	if(parseInt($('#cantidad').val()) < 1 || $('#cantidad').val() == "")
      		{
				cantidad = 0;
      		} else {
      			cantidad = parseInt($('#cantidad').val());
      		}

      		//$('#total').text(cantidad + parseInt($('#stockactual').val()));
      		if($('#tipoajuste_id').val() == 1)
      		{
      			$("#total").html('Stock Total: ' + (cantidad + parseInt($('#stockactual').val())));
      		} else if($('#tipoajuste_id').val() == 2)
      		{	
      			if(parseInt(($('#stockactual').val()) - cantidad) < 0 ){
      				toastr.error('No puede realizar este ajuste negativo');
      				$('#cantidad').val("");
      			} else {
      				$("#total").html('Stock Total: ' + (parseInt($('#stockactual').val()) - cantidad));
      			}
      			
      		} 
		});


		$('#tipoajuste_id').on('change', function(e){
			$( "#cantidad" ).val('');
			$( "#cantidad" ).focus();
			$("#total").html('Stock Total: ' + $('#stockactual').val());
		});


		$( "#guardar" ).click(function() {


			/*estadocampos = 0;

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
      		}*/

      		if($('#tipoajuste_id').val() == "") 
      		{
      			toastr.error('Debe seleccionar un tipo de ajuste.');
      			return false;
      		}


      		if(parseInt($('#cantidad').val()) < 1 || $('#cantidad').val() == "")
      		{
				toastr.error('La cantidad ingresada debe ser mayor a 0.');
      			return false;
      		}

      		

		   	$('#form').submit();

		});



	</script>

@endpush