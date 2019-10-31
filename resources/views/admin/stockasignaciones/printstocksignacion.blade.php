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

@isset($show)
@if($show == 1)
	<br>
	<br>
	<br>
	<br>
	<br>

	<footer>
		<div class="row">
			<center><p><font size=3>_________________________________</font></p></center>
			<center><p><font size=3>Firma Entrega</font></p></center>
		</div>

		<div class="row">
			<center><p><font size=3>_________________________________</font></p></center>
			<center><p><font size=3>Firma Vendedor</font></p></center>
		</div>
	</footer>
@endif
@endif

@endsection

