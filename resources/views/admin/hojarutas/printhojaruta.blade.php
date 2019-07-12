@extends('layouts.report')

@section('cuerpo')
@if(count($hojarutas) > 2000)
	<style type="text/css" media="print">
	 @page {size: Legal landscape}
	</style>
@endif
<h3><center> Cod. Hoja Ruta: {{ $hojaruta->id }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha:  {{ $hojaruta->fecha }}</h3>
<h3><center>Vendedor:  {{ $hojaruta->empleado->empleado }}</h3>
<h3><center> Cantidad de domicilios a visitar:  {{ $cantidad}}</h3>
@if(count($cantidad_b) == 1)
<h3><center> Barrio:  {{ $barrio}}</h3>
@endif
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
						<i></i> Celular
					</center>
				</th>
				<th>
					<center>
						<i></i> Articulo
					</center>
				</th>
				<th>
					<center>
						<i></i> Cant.
					</center>
				</th>
				<th>
					<center>
						<i></i> Venta
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
                	<td >
                		@if($tempid !== $hojaruta->cliente_id)
	                  		<center>
	                  			<b>
									{{ $hojaruta->cliente_id }}
								</b>
							</center>
						@endif
					</td>
                	<td>
                		@if($tempid !== $hojaruta->cliente_id)
							<center>
								<b>
									{{ $hojaruta->cliente }}
								</b>
							</center>
						@endif
					</td>
					<td >
						@if($tempid !== $hojaruta->cliente_id)
							<center>
								@if(count($cantidad_b) > 1)
									B° {{ $hojaruta->barrio }}
								@endif
								@if($hojaruta->calle)
									Calle {{ $hojaruta->calle }}
								@endif
								@if($hojaruta->numero)
									Nro. {{ $hojaruta->numero }}
								@endif
								@if($hojaruta->manzana)
									Mz. {{ $hojaruta->manzana }}
								@endif
								@if($hojaruta->casa)
									C. {{ $hojaruta->casa }}
								@endif
								@if($hojaruta->seccion)
									Seccion {{ $hojaruta->seccion }}
								@endif
								@if($hojaruta->lote)
									Lote {{ $hojaruta->lote }}
								@endif
								@if($hojaruta->edificiotorre)
									Edificio {{ $hojaruta->edificiotorre }}
								@endif
								@if($hojaruta->piso)
									Piso/Dpto {{ $hojaruta->piso }}
								@endif
								@if($hojaruta->referenciadomicilio)
									Ref. {{ $hojaruta->referenciadomicilio }}
								@endif

							</center>
						@endif
					</td>
					<td >
						@if($tempid !== $hojaruta->cliente_id)
							<center>
								{{ $hojaruta->celular }}
							</center>
						@endif
					</td>
					<td >
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
                    <td>
						
					</td>
                </tr>
                <?php 
					$tempid = $hojaruta->cliente_id;
				?>
            @endforeach
		</tbody>
	</table>				
</div>

<br>
<br>

<script>

  	var cantidad = {!! count($hojarutas) !!};

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

