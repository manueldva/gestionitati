@extends('layouts.report')

@section('cuerpo')
<h3><center>Informe </h3>
<h3><center>Clientes que no realizan una compra desde: @if($fechaanterior) {{ $fechaanterior}} @endif</center></h3>
<h3><center>Cantidad de clientes en la lista: {{ count($resultado) }}</center></h3>
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
											<th> <center>Vendedor</center></th>
											<th> <center>Codigo Cliente</center></th>
											<th> <center>Cliente</center></th>
											<th> <center>Barrio</center></th>
											<th> <center>Ultima Compra</center></th>
										</tr>
									</thead>
									<tbody>
										@foreach($resultado as $res)
											<tr>
											<td>
												 <center>
											 		{{ $res->Vendedor }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->Codigo }}
											     </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->Cliente }}
											      </center>
											 	</td>
												 <td>
												 <center>
											 		{{ $res->Barrio }}
											      </center>
											 	</td>
											 	<td>
												 <center>
											 		{{ $res->Fecha }}
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

