@extends('layouts.report')

@section('cuerpo')

<h3><center> Cod. Hoja Ruta: {{ $hojaruta->id }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha:  {{ $hojaruta->fecha }}</h3>
<h3><center>Vendedor:  {{ $hojaruta->empleado->empleado }}</h3>

<h3><center> Barrio:  {{ $barrio}}</h3>
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
			      

			      <h3 class="box-title">Datos procesados hasta el momento: @if($fecha) {{ $fecha}} @endif</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	
					<label>Articulos cargados hasta el momento:</label> 
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_general" class="table table-striped table-hover" data-form="Form">
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
				</div>
				<br>
				<br>
				<div class="col-md-6 pull-right">
					<label>Discriminado por tipo de pago:</label>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_pagos" class="table table-striped table-hover" data-form="Form">
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
					<br>
					<hr>
					<h3>
						<div class="form-group">
							
							<label>Cobranzas extras: <b>{{ $totalcobranza }} </b> </label>
						</div>
					</h3>
					<h3>
						<div class="form-group">
							<label>Efectivo total a recibir:  <b>{{ $totalgeneralefectivo }} </b> </label>

						</div>
					</h3>
				</div>
			<!-- aca agregar el div col-6 -->
			
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
</div>

</center>

<script>




</script>


@endsection

