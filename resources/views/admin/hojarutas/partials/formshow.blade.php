
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
						{{ form::select('estado', ['1' => 'En Reparticion', '2' => 'Procesado'], null, ['class' => 'form-control', 'readonly'] ) }}
			      	</div>
			      	<div class="form-group">
						{{ form::label('barrio', 'barrio/s') }}
						{{ form::text('barrio',$barrio, ['class' => 'form-control', 'id' => 'barrio', 'readonly']) }}
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
			      

			      <h3 class="box-title">Datos procesados hasta el momento:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('fechacobro', 'Fecha Cobro *') }}
						{{ form::date('fechacobro',null, ['class' => 'form-control', 'id' => 'fechacobro']) }}
					</div>
					<hr>
					{{ form::label('fechacobro', 'Articulos cargados hasta el momento:') }}
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_clientes" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> Articulo</th>
											<th> Precio U.</th>
											<th> Cantidad</th>
											<th> Subtotal</th>
										</tr>
									</thead>
									<tbody>
										@foreach($t_por_articulo as $total)
											<tr>
											 	<td>
											 		{{ $total->articulo }}
											 	</td>
											 	<td>
											 		{{ $total->precio }}
											 	
											 	</td>
											 	<td>
											 		{{ $total->cantidad }}
											 	</td>
											 	<td>
											 		{{ $total->monto }}
											 	</td>

											</tr>
										@endforeach
										<tr>
											<td>
												<b>
													Totales
												</b>
												
											</td>
											<td>
												
											</td>
											<td>
												<b>
													{{ $cantidadgeneral }}
												</b>
											</td>
											<td>
												<b>
													{{ $totalgeneral }}
												</b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<hr>
					{{ form::label('fechacobro', 'Discriminado por tipo de pago:') }}
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_clientes" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> Tipo Pago</th>
											<th> Monto</th>
										</tr>
									</thead>
									<tbody>
										@foreach($t_tipopago as $total)
											<tr>
											 	<td>
											 		
											 		{{ $total->tipo }}
											 	</td>
											 	<td>
											 		<b>
											 		{{ $total->monto }}
											 		</b>
											 	</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						{{ form::label('cobranza', 'Cobranzas extras:') }}
						{{ form::text('cobranza',$totalcobranza, ['class' => 'form-control', 'id' => 'cobranza', 'readonly','style' =>'font-weight: bold;' ]) }}
					</div>
					<div class="form-group">
						{{ form::label('cobranza', 'Efectivo total a recibir:') }}
						{{ form::text('cobranza',$totalgeneralefectivo, ['class' => 'form-control', 'id' => 'cobranza', 'readonly', 'style' =>'font-weight: bold;  font-size:20px;']) }}
					</div>
				</div>
			<!-- aca agregar el div col-6 -->
			
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
											<i></i> Articulo
										</center>
									</th>
									<th>
										<center>
											<i></i> Cantidad
										</center>
									</th>
									<th>
										<center>
											Tipo Pago
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
								@if($hojaruta->estado == 1)
				                	<tr  style="color:red">
				               	@else
				               		<tr>
				               	@endif
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
										@if($cant_barrio > 1)
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
									<td >
										<center>
										{{ $hojaruta->articulo }}
										</center>
									</td>
									<td>
										<center>
										{{ $hojaruta->cantidad }}
										</center>
									</td>
									<td>
										<center>
										@if($hojaruta->estado == 2)
											@if($hojaruta->tipopago == 0)
												Sin Cargo
											@elseif($hojaruta->tipopago == 1)
												Efectivo
											@else
												Cuenta Corriente
											@endif
										@endif
										</center>
									</td>
									<td >
										<center>
										{{ $hojaruta->fechacarga }}
										</center>
									</td>
				                    <td>
										<center>
											@if($hojaruta->estado == 1)
												Sin Entregar
											@else
												Entregado
											
											@endif
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



	</script>

@endpush