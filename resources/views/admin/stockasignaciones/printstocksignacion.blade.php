@extends('layouts.report')

@section('cuerpo')

<h3><center> Cod. Asignación: {{ $stockasignacion->id }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha:  {{ $stockasignacion->fecha }}</h3>
<h3><center>Vendedor:  {{ $stockasignacion->empleado->empleado }}</h3>
<h3><center> Cantidad total de articulos:  {{ $cantidad }} - Carga Nro {{ $carga }}</h3>

<div class="portlet-body">
	<table id="clientes" class="table table-striped table-bordered table-advance table-hover table-responsive tablesorter">
											
		<thead>
			<tr>
				<th>
					<center>
						<i></i> Codigo Stock
					</center>	
				</th>
				<th>
					<center>
						<i></i> Descripción Stock
					</center>	
				</th>
				<th>
					<center>
						<i></i>  Cantidad
					</center>	
				</th>
				<!--
				<th>
					<center>
						<i></i> Devuelve
					</center>	
				</th>
				-->
			</tr>
		</thead>
		<tbody>
			@foreach($stockasignaciondetalles as $stock)
				<tr>
					<td>
						<center>
							{{ $stock->stockventa_id }}
						</center>
					</td>
					<td>
						<center>
							{{ $stock->descripcion }}
						</center>
					</td>
					<td>
						<center>
							{{ $stock->cantidad }}
						</center>
					</td>
					<!--
					<td>
						<center>
							@if($stockasignacion->estado == 2)
								{{ $stock->devuelve }}
							@endif
						</center>
					</td>-->
				</tr>

			@endforeach
		</tbody>
	</table>				
</div>

	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<p style="text-align: left"><font size=3>_________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________________</font></p>
			<p  style="text-align: left"><font size=3>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Entrega &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma Recibe</font></p>
		</div>
		
	</div>


@endsection

