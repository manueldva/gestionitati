
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
			     

			      <h3 class="box-title">Datos del Cliente:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('codigo', 'Codigo Cliente') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly']) }}
					</div>

			    	<div class="form-group">
						{{ form::label('apellido', 'Apellido') }}
						{{ form::text('apellido', null , ['class' => 'form-control', 'id' => 'apellido', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('nombre', 'Nombre') }}
						{{ form::text('nombre',  null , ['class' => 'form-control', 'id' => 'nombre', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('cliente', 'Razon Social') }}
						{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'readonly']) }}
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			      <h3 class="box-title">Detalle Cobro:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('fechapago', 'Fecha *') }}
						{{ form::date('fechapago', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechapago']) }}
					</div>
			    	<div class="form-group">
						{{ form::label('monto', 'Monto *') }}
						{{ form::number('monto',null, ['class' => 'form-control', 'id' => 'monto']) }}					
					</div>
					
					<div class="form-group">
			      		{{ form::label('tipopago', 'Tipo') }}
						@if($permitirpago == 1)
							{{ form::select('tipopago', ['1' => 'Deuda', '2' => 'Pago'], null, ['class' => 'form-control'] ) }}
						@else
							{{ form::select('tipopago', ['1' => 'Deuda'], null, ['class' => 'form-control'] ) }}
						@endif
			      	</div>

					
				</div>
			    <!-- /.box-body -->
			</div>
			<!-- /.col -->
			
			<!-- aca agregar el div col-6 -->
			


	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
</div>
	<!-- /.col -->
<!--      segundo div general                              -->
	<div class="col-md-12">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-money"></i>

	      <h3 class="box-title">Monto Deuda Actual:  <b> $  {{ $deuda}} </b></h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="form-group">
				<div class="form-group">
					<div class="table-responsive">
						<table id="table_clientes" class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
								<!--<th width="10px"> ID</th>-->
									<th> Fecha Movimiento</th>
									<th> Monto</th>
									<th>Tipo</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cuentacorrientedetalles as $ccd)
									@if($ccd->tipopago == 1)
										<tr  style="color:red">		
									@else
										<tr  style="color:blue">
									@endif
											<td>
												{{ $ccd->fechapago }}
											</td>
											<td>
												{{ $ccd->monto }}
											</td>
											<td>
												@if($ccd->tipopago == 1)
													Deuda
											@else
												Pago
											@endif
											</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
	    </div>
	  </div>
	</div>
<!--      segundo div general                              -->
</div>	
	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		$( "#guardar" ).click(function() {


			if($('#fechapago').val() == '') {


				toastr.error('Debe ingresar una fecha');
				return false;
			}

			if($('#monto').val() == '') {


				toastr.error('Debe ingresar un monto valido');
				return false;
			}

			if($('#monto').val() < 1) {


				toastr.error('Debe ingresar un monto valido');
				return false;
			}


		   	$('#form').submit();

		});

	</script>

@endpush