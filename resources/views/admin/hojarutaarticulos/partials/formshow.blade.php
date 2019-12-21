
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
						{{ form::label('articulo_id', 'Articulo') }}
						{{ form::text('articulo_id', $hojarutaarticulo->articulo->descripcion, ['class' => 'form-control', 'id' => 'articulo_id', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('fecha', 'Fecha') }}
						{{ form::date('fecha', null, ['class' => 'form-control', 'id' => 'fecha', 'readonly']) }}
					</div>
			      	<div class="form-group">
			      		{{ form::label('estado', 'Estado') }}
						{{ form::select('estado', ['1' => 'En Reparticion', '2' => 'Procesado'], null, ['class' => 'form-control', 'readonly'] ) }}
			      	</div>
			      	<div class="form-group">
						{{ form::label('cant_cli', 'Cantidad de Clientes') }}
						{{ form::text('cant_cli', $cant_cli, ['class' => 'form-control', 'id' => 'cant_cli', 'readonly']) }}
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->
			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			</div>
			<!-- aca agregar el div col-6 -->
		
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
											<i></i> Cantidad
										</center>
									</th>
									<th>
										<center>
											<i></i> Cobro
										</center>
									</th>
									
									<th>
										<center>
											Fecha de Carga
										</center>
									</th>
									<th>
										<center>
											Estado
										</center>
									</th>
								</tr>
							</tr>
						</thead>
						<tbody>
							@foreach ($detalles as $hojaruta)
								<tr>
				                  	<td >
				                  		<center>
										{{ $hojaruta->cliente_id }}
										</center>
									</td>
									<td >
										<center>
										{{ $hojaruta->cliente }}
										</center>
									</td>
									<td >
										<center>
										@if($hojaruta->barrio)
											B° {{ $hojaruta->barrio }}
										@endif
										@if($hojaruta->calle)
											Calle {{ $hojaruta->calle }}
										@endif
										@if($hojaruta->numero)
											Nro. {{ $hojaruta->numero }}
										@endif
										@if($hojaruta->manzana)
											Mz. {{ $hojaruta->manzana }}
										@endif
										@if($hojaruta->casa)
											C. {{ $hojaruta->casa }}
										@endif
										@if($hojaruta->seccion)
											Seccion {{ $hojaruta->seccion }}
										@endif
										@if($hojaruta->lote)
											Lote {{ $hojaruta->lote }}
										@endif
										@if($hojaruta->edificiotorre)
											Edificio {{ $hojaruta->edificiotorre }}
										@endif
										@if($hojaruta->piso)
											Piso/Dpto {{ $hojaruta->piso }}
										@endif
										@if($hojaruta->referenciadomicilio)
											Ref. {{ $hojaruta->referenciadomicilio }}
										@endif

										</center>
									</td>
									<td>
										<center>
										{{ $hojaruta->cantidad }}
										</center>
									</td>
									<td>
										<center>
										
										</center>
									</td>
									<td>
										<center>
										
										</center>
									</td>
									<td >
										<center>
											Sin Cobrar
										</center>
									</td>
				                </tr>
				            @endforeach
						</tbody>
					</table>
					
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

		$( "#buscarprocesado" ).click(function() {

			$("#table_general").find("tr:gt(0)").remove();

			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojarutashowdetalletotales',
				async: false,
				//url: '../api/validardocumento',
				data: {id: $('#id').val(), fecha: $('#fechacobro').val() }
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				
	
					//variables para guardar en la grilla
					$.each(data, function(key, value){
						//alert(value.articulo);
						$('#table_general tbody').prepend(
						'<tr>' + 
						'<td><b>Totales</b></td>' +
						'<td></td>' +
						'<td><b>' + value.cantidad + '</b></td>' +
						'<td><b>' + value.monto + '</b></td>' +
						'</tr>');
			    	})							
				
			});

			//var fecha = $('#fechacobro').val();
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojarutashowdetallegeneral',
				//async: false,
				//url: '../api/validardocumento',
				data: {id: $('#id').val(), fecha: $('#fechacobro').val() }
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				
	
					//variables para guardar en la grilla
					$.each(data, function(key, value){
						//alert(value.articulo);
						$('#table_general tbody').prepend(
						'<tr>' + 
						'<td>' + value.articulo + '</td>' +
						'<td>' + value.precio + '</td>' +
						'<td>' + value.cantidad + '</td>' +
						'<td>' + value.monto + '</td>' +
						'</tr>');
			    	})							
				
			});



			//para cobranza
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojarutashowdetallecobranza',
				//async: false,
				//url: '../api/validardocumento',
				data: {id: $('#id').val(), fecha: $('#fechacobro').val() }
			}).done(function(data) {
				//var $empleado = $('#empleado'); 

				$('#cobranza').val(data.toFixed(2));		
				
			});


			//var fecha = $('#fechacobro').val();
			$("#table_pagos").find("tr:gt(0)").remove();
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/hojarutashowdetalletipopago',
				//async: false,
				//url: '../api/validardocumento',
				data: {id: $('#id').val(), fecha: $('#fechacobro').val() }
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				
	
					//variables para guardar en la grilla
					$.each(data, function(key, value){
						//alert(value.articulo);

						$('#table_pagos tbody').prepend(
						'<tr>' + 
						'<td><b>' + value.tipo + '</b></td>' +
						'<td><b>' + value.monto + '</b></td>' +
						'</tr>');

						if(value.tipo == 'Efectivo') {

							var temp1 = $("#cobranza").val();
							var temp2 = parseFloat(temp1) + parseFloat(value.monto);
							

							$('#total').val(parseFloat(temp2).toFixed(2));		
						}	
			    	})							
				
			});


		});


		$('#imprimir').on('click', function(e){
            
            var id = $("#id").val();

            var fecha = $("#fechacobro").val();
            //alert(fecha);
            if (fecha == '')
            {
                fecha = '0';
            }

            e.preventDefault();
            window.open("{{url('printhojarutadetalle')}}/"+ id +"/"+ fecha);
			

        });

	</script>

@endpush