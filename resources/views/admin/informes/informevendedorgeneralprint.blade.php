@extends('layouts.report')

@section('cuerpo')

<h3><center> Cod. Hoja Ruta: 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha:  {{date("Y-m-d")}}</h3>
<h3><center>Vendedor: {{ $empleado->empleado}}</h3>

<h3><center> Barrio: Todos</h3>
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
			      

			      <h3 class="box-title">Datos procesados desde @if($fechadesde) {{ $fechadesde}} @endif Hasta  @if($fechahasta) {{ $fechahasta}} @endif</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	
					<label>Articulos cargados:</label> 
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
													cantidad total
												</b>
											</td>
											<td>
												<b>
													total general
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
							
							<label>Cobranzas extras: <b> 21231 </b> </label>
						</div>
					</h3>
					<h3>
						<div class="form-group">
							<label>Efectivo total a recibir:  <b>54654 </b> </label>

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

