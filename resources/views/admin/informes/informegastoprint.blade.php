@extends('layouts.report')

@section('cuerpo')
<h3><center>Informe Gastos </center></h3>

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
			    	
					<label>Datos procesados desde @if($fechadesde) {{ $fechadesde}} @endif Hasta  @if($fechahasta) {{ $fechahasta}} @endif</label> 
					<div class="form-group">
					
						<div class="form-group">
							<div class="table-responsive">
								<table id="table_general" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th> <center>Fecha</center></th>
											<th> <center>Comprobante</center></th>
											<th> <center>Tipo Gasto</center></th>
											<th> <center>Monto</center></th>
											<th> <center>Detalle</center></th>
											
										</tr>
									</thead>
									<tbody>
										@foreach($gastos as $res)
											<tr>
											<td>
												 <center>
											 		{{ $res->fecha }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->tipocomprobante->descripcion }}
											     </center>
											 	</td>
												 <td>
												 <center>
											 		{{ $res->rubrogasto->descripcion }}
											      </center>
											 	</td>
												 <td>
												 <center>
											 		{{ $res->monto }}
											      </center>
											 	</td>

											 	<td>
												 <center>
											 		{{ $res->detalle }}
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

