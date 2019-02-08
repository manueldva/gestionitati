@extends('layouts.report')

@section('cuerpo')

 <h3><center><?php echo $usuario;?></h3>
 <h3><center> Desde <?php echo $fechadesde;?> Hasta   <?php echo $fechahasta;?></h3>

<div class="portlet-body">
	<table id="table_stock" class="table table-striped table-bordered table-advance table-hover table-responsive">
											
		<thead>
			<tr>
            <th>
				<center>
					<i></i> Nro Tarea
				</center>	
			</th>
			<th>
				<center>
					<i></i> Fecha
				</center>	
			</th>
            @if($usuario == 'Todos')
			<th>
				<center>
					<i></i> Usuario
				</center>	
			</th>
            @endif
            <th>
				<center>
					<i></i> Motivo
				</center>
			</th>
			<th>
				<center>
					<i></i> Titulo Tarea
				</center>
			</th>
			
			</tr>
		</thead>
		<tbody>
			<?php foreach($tareas as $tarea){ ?>
                 
                <tr>
                    <td><center>
                    <?php 
						if (isset($tarea->id)) {
							echo $tarea->id;
						} 
					?></center>
					</td>	
                    <td><center>
                    <?php 
						if (isset($tarea->fecha)) {
							echo $tarea->fecha;
						} 
					?></center>
					</td>	
                    @if($usuario == 'Todos')
					<td><center>
                    <?php 
						if (isset($tarea->usuario_alta)) {
							echo $tarea->usuario_alta;
						} 
					?></center>
					</td>
                    @endif
					<td><center>
                    <?php 
						if (isset($tarea->motivo_id)) {
							echo $tarea->motivo->descripcion;
						} 
					?></center>
					</td>
					<td><center>
                    <?php 
						if (isset($tarea->titulotarea)) {
							echo $tarea->titulotarea;
						} 
					?></center>
					</td>				
					
                 </tr>
                    
            <?php  } ?>
		</tbody>
	</table>				
</div>

@stop