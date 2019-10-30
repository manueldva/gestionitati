@extends('layouts.report')

@section('cuerpo')
<h3><center>Informe Movimientos Cliente </h3>
<h3><center>Codigo: {{ $cliente->id }}</h3>
<h3><center>Cliente: @if($cliente->tipocliente_id == 1) {{ $cliente->apellido }} {{ $cliente->nombre }} @else {{ $cliente->cliente }}  @endif </center></h3>

<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">


	      <h3 class="box-title">
	      	
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			
			<!-- /.col -->
			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	
					<label>Datos procesados desde @if($fechadesde) {{ $fechadesde}} @endif Hasta  @if($fechahasta) {{ $fechahasta}} @endif</label> 
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_general" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> <center>Fecha</center></th>
											<th> <center>Articulo</center></th>
											<th> <center>Precio</center></th>
											<th> <center>Cantidad</center></th>
											<th> <center>Subtotal</center></th>
											<th> <center>Tipo Pago</center></th>
										</tr>
									</thead>
									<tbody>
										@foreach($t_por_articulo as $res)
											<tr>
											<td>
												 <center>
											 		{{ $res->fecha }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->articulo }}
											     </center>
											 	</td>
												 <td>
												 <center>
											 		${{ $res->precio }}
											      </center>
											 	</td>
												 <td>
												 <center>
											 		{{ $res->cantidad }}
											      </center>
											 	</td>

											 	<td>
												 <center>
											 		${{ $res->subtotal }}
												 </center>
											 	</td>
												 <td>
												 <center>
											 		@if($res->tipopago == 1)
													 	Eectivo
													@elseif($res->tipopago == 2)
														Cuenta Corriente
													@else
														Sin Cargo
													@endif
												 </center>
											 	</td>
											</tr>
										@endforeach
										<tr>
											<td>
												<center>
												<b>
													Totales
												</b>
												</center>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												<center>

												<b>
													{{ $cantidadgeneral }}
												</b>
												</center>

											</td>
											<td>
												<center>

												<b>
												$ {{ $totalgeneral }}
												</b>
												</center>

											</td>
											<td>
												<b>
												
												</b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				
			<!-- aca agregar el div col-6 -->
			
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <br>
	  <br>
	  <br>
	  <!-- /.box -->
	</div>
</div>

</center>

<script>




</script>


@endsection

