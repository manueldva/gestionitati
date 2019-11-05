@extends('layouts.report')

@section('cuerpo')

<h3><center>Vendedor: {{ $empleado->empleado}}</h3>
<h3><center>Datos procesados desde @if($fechadesde) {{ $fechadesde}} @endif Hasta  @if($fechahasta) {{ $fechahasta}} @endif</center></h3>

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
			      

			      <!--<h3 class="box-title">Datos procesados desde @if($fechadesde) {{ $fechadesde}} @endif Hasta  @if($fechahasta) {{ $fechahasta}} @endif</h3>-->
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	
					<label>Stock Asignado:</label> 
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_general" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> Fecha</th>
											<th> Stock</th>
											<th> Retiro</th>
											<th> Dev. Carg.</th>
											<th> Dev. Vac.</th>
											<th> Contrato</th>
											<th> Recuperado</th>
											<th> Faltante</th>
											<th> Volvio</th>
										</tr>
									</thead>
									<tbody>
										@foreach($t_por_articulo as $total)
											<tr>
												<td>
											 		{{ $total->fecha }}
											 	</td>
											 	<td>
											 		{{ $total->descripcion }}
											 	</td>
											 	<td>
											 		{{ $total->cantidad }}
											 	
											 	</td>
											 	<td>
											 		{{ $total->devuelve }}
											 	</td>
											 	<td>
											 		{{ $total->vacios }}
											 	</td>
												 <td>
											 		{{ $total->contrato }}
											 	</td>
												<td>
												@if($total->cantidad < ($total->devuelve + $total->vacios + $total->contrato))
											 		{{ ($total->devuelve + $total->vacios + $total->contrato) - $total->cantidad }}
												@endif
											 	</td>
												<td>
												@if($total->cantidad > ($total->devuelve + $total->vacios + $total->contrato))
											 		{{ $total->cantidad - ($total->devuelve + $total->vacios + $total->contrato) }}
												@endif
											 	</td>
												 <td>
											 		{{ ($total->devuelve + $total->vacios + $total->contrato) }}
											 	</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="col-md-6 pull-right">
				<!--
					<label>Discriminado por tipo de pago:</label>
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_pagos" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>

											<th> Tipo Pago</th>
											<th> Monto</th>
										</tr>
									</thead>
									<tbody>
										
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<br>
					<hr>
					<h3>
						<div class="form-group">
							
							<label>Cobranzas extras: <b>  </b> </label>
						</div>
					</h3>
					<h3>
						<div class="form-group">
							<label>Efectivo total a recibir:  <b> </b> </label>

						</div>
					</h3>
				</div>-->
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

