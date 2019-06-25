@extends('layouts.report')

@section('cuerpo')

 <h3><center>Vendedor:  {{ $hojaruta->empleado->empleado }}</h3>
<h3><center> Cantidad de domicilios a visitar:  {{ $cantidad}}</h3>

<br>

<h3><center> Detalle:</h3>
<div class="portlet-body">
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
						<i></i> Articulos
					</center>
				</th>
				<th>
					<center>
						<i></i> Cantidad
					</center>
				</th>
				<th>
					<center>
						<i></i> Observación
					</center>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($hojarutas as $hojaruta)
	                  <tr>
	                  	<td>
	                  		<center>
							{{ $hojaruta->cliente_id }}
							</center>
						</td>
						<td>
							<center>
							{{ $hojaruta->cliente }}
							</center>
						</td>
						<td>
							<center>
							{{ $hojaruta->barrio }}
							</center>
						</td>
						<td>
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
							
						</td>
	                  </tr>
	                @endforeach
		</tbody>
	</table>				
</div>

<br>
<br>


<h3><center> Articulos Extras</h3>

<div class="portlet-body">
	<table id="extras" class="table table-striped table-bordered table-advance table-hover table-responsive tablesorter">
											
		<thead>
			<tr>
	            <th>
					<center>
						<i></i>  Codigo
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
				
			</tr>
		</thead>
		<tbody>
			@foreach ($extras as $extra)
                  <tr>
                  	<td>
                  		<center>
						{{ $extra->articulo->codigo }}
						</center>
					</td>
					<td>
						<center>
						{{ $extra->articulo->descripcion }}
						</center>
					</td>
					<td>
						<center>
						{{ $extra->cantidad }}
						</center>
					</td>
                  </tr>
                @endforeach
		</tbody>
	</table>				
</div>

@endsection

