
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
			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			      <h3 class="box-title">Detalle Cobro:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('fechacobranza', 'Fecha Cobro *') }}
						{{ form::date('fechacobranza', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechacobranza']) }}
					</div>
			    	<div class="form-group">
						{{ form::label('monto', 'Monto *') }}
						{{ form::number('monto',null, ['class' => 'form-control', 'id' => 'monto']) }}					
					</div>

					<hr>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_clientes" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> Fecha Cobro</th>
											<th> Monto</th>
										</tr>
									</thead>
									<tbody>
										@foreach($cobranzas as $cobranza)
											<tr>
											 	<td>
											 		{{ $cobranza->fechacobranza }}
											 	</td>
											 	<td>
											 		{{ $cobranza->monto }}
											 	</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
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
	<!-- /.col -->
<!--      segundo div general                              -->


	
<!--      segundo div general                              -->
</div>	
	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		$( "#guardar" ).click(function() {


			if($('#fechacobranza').val() == '') {


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