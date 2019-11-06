@extends('layouts.report')

@section('cuerpo')
<h3><center>Informe </h3>
<h3><center>Informe de Stock Actual de Ventas</center></h3>
<h3><center>Fecha/Hora Impresion : <?php echo date('Y-m-d H:i:s');?></center></h3>
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
			      

			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	
					<label>Clientes:</label> 
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_general" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> <center>StockVenta</center></th>
											<th> <center>Stock Actual</center></th>
											<th> <center>Ultima Modificación</center></th>
											<th> <center>Usuario Ultima Modificación</center></th>
										</tr>
									</thead>
									<tbody>
										@foreach($stockventaactual as $res)
											<tr>
											<td>
												 <center>
											 		{{ $res->stockventa }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->stockactual }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->ultimamodifiacion }}
											      </center>
											 	</td>
												 <td>
												 <center>
											 		{{ $res->usuario_modi }}
											      </center>
											 	</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				
			<!-- aca agregar el div col-6 -->
			
			</div>
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <br>
	  <br>
	  <br>
	  <!-- /.box -->
	</div>
</div>

</center>

<script>




</script>


@endsection

