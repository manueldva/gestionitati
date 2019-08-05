@extends('layouts.report')

@section('cuerpo')
@if(count($detalles) > 2000)
	<style type="text/css" media="print">
	 @page {size: Legal landscape}
	</style>
@endif
<h3><center> Cod. Hoja Ruta: {{ $hojarutaarticulo->id }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha:  {{ $hojarutaarticulo->fecha }}</h3>
<h3><center>Articulo:  {{ $hojarutaarticulo->articulo->descripcion }}</h3>
<h3><center> Cantidad de domicilios a visitar: {{ count($detalles) }}</h3>

<div class="portlet-body">
	
			@foreach ($detalles as $det)
				@if($tempid2 !== $det->barrio)
									</tbody>
						</table>				
					</div>
					<h3><center> Barrio:  {{ $det->barrio}} </h3>
					
						<table id="clientes" class="table table-striped table-bordered table-advance table-hover table-responsive tablesorter">
																
							<thead>
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
											<i></i> Celular
										</center>
									</th>
									<th>
										<center>
											<i></i> Cant.
										</center>
									</th>
									<th>
										<center>
											<i></i> Cobro
										</center>
									</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
				                	<td >
				                		@if($tempid !== $det->cliente_id)
					                  		<center>
					                  			<b>
													{{ $det->cliente_id }}
												</b>
											</center>
										@endif
									</td>
				                	<td>
				                		@if($tempid !== $det->cliente_id)
											<center>
												<b>
													{{ $det->cliente }}
												</b>
											</center>
										@endif
									</td>
									<td >
										@if($tempid !== $det->cliente_id)
											<center>
										
												
												@if($det->calle)
													Calle {{ $det->calle }}
												@endif
												@if($det->numero)
													Nro. {{ $det->numero }}
												@endif
												@if($det->manzana)
													Mz. {{ $det->manzana }}
												@endif
												@if($det->casa)
													C. {{ $det->casa }}
												@endif
												@if($det->seccion)
													Seccion {{ $det->seccion }}
												@endif
												@if($det->lote)
													Lote {{ $det->lote }}
												@endif
												@if($det->edificiotorre)
													Edificio {{ $det->edificiotorre }}
												@endif
												@if($det->piso)
													Piso/Dpto {{ $det->piso }}
												@endif
												@if($det->referenciadomicilio)
													Ref. {{ $det->referenciadomicilio }}
												@endif
											
											</center>
										@endif
									</td>
									<td >
										@if($tempid !== $det->cliente_id)
											<center>
												
												{{ $det->celular }}
											
											</center>
										@endif
									</td>
									
									<td>
										<center>
										{{ $det->cantidad }}
										</center>
									</td>
									 <td>
										
									</td>
				                    
				                </tr>
				                <?php 
									$tempid = $det->cliente_id;
									$tempid2 = $det->barrio;
								?>
				@else

                <tr>
                	<td >
                		@if($tempid !== $det->cliente_id)
	                  		<center>
	                  			<b>
									{{ $det->cliente_id }}
								</b>
							</center>
						@endif
					</td>
                	<td>
                		@if($tempid !== $det->cliente_id)
							<center>
								<b>
									{{ $det->cliente }}
								</b>
							</center>
						@endif
					</td>
					<td >
						@if($tempid !== $det->cliente_id)
							<center>
						
								@if($det->calle)
									Calle {{ $det->calle }}
								@endif
								@if($det->numero)
									Nro. {{ $det->numero }}
								@endif
								@if($det->manzana)
									Mz. {{ $det->manzana }}
								@endif
								@if($det->casa)
									C. {{ $det->casa }}
								@endif
								@if($det->seccion)
									Seccion {{ $det->seccion }}
								@endif
								@if($det->lote)
									Lote {{ $det->lote }}
								@endif
								@if($det->edificiotorre)
									Edificio {{ $det->edificiotorre }}
								@endif
								@if($det->piso)
										Piso/Dpto {{ $det->piso }}
								@endif
								@if($det->referenciadomicilio)
									Ref. {{ $det->referenciadomicilio }}
								@endif
							
							</center>
						@endif
					</td>
					<td >
						@if($tempid !== $det->cliente_id)
							<center>
								
								{{ $det->celular }}
							
							</center>
						@endif
					</td>
					
					<td>
						<center>
						{{ $det->cantidad }}
						</center>
					</td>
					 <td>
						
					</td>
                    
                </tr>
                <?php 
					$tempid = $det->cliente_id;
					$tempid2 = $det->barrio;
				?>
			@endif
            @endforeach
		</tbody>
	</table>				
</div>

<br>
<br>

<script>

  	var cantidad = {!! count($detalles) !!};

	 if(cantidad > 2000) {
		window. onload = function () {
		    window.print();
		    setTimeout(function () { window.close(); }, 100);
		}

	}
  /*window. onload = function () {
    window.print();
    setTimeout(function () { window.close(); }, 100);
  }*/




</script>


@endsection

