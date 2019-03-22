@extends('layouts.report')

@section('cuerpo')

 <h3><center>Barrio: <?php echo $barriodesc;?></h3>
 <h3><center> Contratos Registrados: <?php echo $contratos;?></h3>

<div class="portlet-body">
	<table id="table_stock" class="table table-striped table-bordered table-advance table-hover table-responsive">
											
		<thead>
			<tr>
            <th>
				<center>
					<i></i> Cod. Articulo
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
			<?php foreach($data as $dt){ ?>
                 
                <tr>
                    <td><center>
                    <?php 
						if (isset($dt['codigo'])) {
							echo $dt['codigo'];
						} 
					?></center>
					</td>	
                    <td><center>
                    <?php 
						if (isset($dt['articulo'])) {
							echo $dt['articulo'];
						} 
					?></center>
					</td>	
					<td><center>
                    <?php 
						if (isset($dt['cantidad'])) {
							echo $dt['cantidad'];
						} 
					?></center>
					</td>				
					
                 </tr>
                    
            <?php  } ?>
		</tbody>
	</table>				
</div>

@stop