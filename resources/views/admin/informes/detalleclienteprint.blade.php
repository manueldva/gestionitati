@extends('layouts.report')

@section('cuerpo')

 <h3><center>Barrio: <?php echo $barriodesc;?></h3>
<h3><center> Clientes Registrados: <?php echo $cantidad;?></h3>


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
			<?php foreach($clientes as $cliente){ ?>
                 
                <tr>
                    <td class="col-md-4"><center>
                    <?php 
						if (isset($cliente->cliente->id )) {
							echo $cliente->cliente->id;
						} 
					?></center>
					</td>	
                    <td><center>
                    <?php 
						if (isset($cliente->cliente->id )) {
							if($cliente->cliente->tipocliente_id == 1)
							{
								echo $cliente->cliente->apellido . ' ' . $cliente->cliente->nombre ;
							}else{

								echo $cliente->cliente->cliente ;
							}
							
						} 
					?></center>
					</td>	
					
					<td><center>
                    <?php 
						if (isset($cliente->usuario_modi)) {
							echo $cliente->usuario_modi;
						} 
					?></center>
					</td>	
					<td><center>
                    <?php 
						if (isset($cliente->cliente->celular )) {
							echo $cliente->cliente->celular;
						} 
					?></center>
					</td>
					<td>
					<center>
						@isset($cliente->usuario_alta)
							{!! $cliente->usuario_alta !!}
						@endif
                   	</center>
					</td>
					<td>
                    
					</td>
					<td>
                    
					</td>
					
                 </tr>
                    
            <?php  } ?>
		</tbody>
	</table>				
</div>

@endsection

