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
					<i></i> Tipo Cliente
				</center>
			</th>
			
			<th>
				<center>
					<i></i> Estado
				</center>
			</th>
			
			
			</tr>
		</thead>
		<tbody>
			<?php foreach($clientes as $cliente){ ?>
                 
                <tr>
                    <td><center>
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
						if (isset($cliente->cliente->tipocliente_id )) {
							echo $cliente->cliente->tipocliente->descripcion;
						} 
					?></center>
					</td>	
					
					<td><center>
                    <?php 
						if (isset($cliente->cliente->estado )) {
							if($cliente->cliente->estado == 0) {
								echo "Inactivo";
							} else {
								echo "Activo";
							}	
						
						} 
					?></center>
					</td>				
					
                 </tr>
                    
            <?php  } ?>
		</tbody>
	</table>				
</div>

@endsection

