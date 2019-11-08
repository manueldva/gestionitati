
<input type="hidden" name="listado_articulos" id="id_lista_articulos">
<div class="row">
	
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">
	      
	      <h3 class="box-title">
	      	
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="col-md-12">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Datos del Stock:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>	
										<td>
											{{ form::label('stockactual', 'Stock Actual Producción') }}
											{{ form::number('stockactual', null, ['class' => 'form-control', 'id' => 'stockactual', 'readonly']) }}
										</td>
										<td> 
											{{ form::label('cantidad', 'Cantidad a Enviar') }}
											{{ form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']) }}
											
										</td>
									</tr>
									<tr>
										<td> 
											{{ form::label('descripcion', 'Descripcion') }}
											{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion', 'readonly']) }}
											
										</td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			

	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->


	</div>
	<!-- /.col -->
<!--      segundo div general                              -->

	
	
	  <!-- /.box -->


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		var APP_RL = "{{ url('/') }}";



		$( "#guardar" ).click(function() {


			$( "#guardar" ).hide();

      		if(parseInt($('#cantidad').val()) < 1 || $('#cantidad').val() == "")
      		{
				toastr.error('La cantidad ingresada debe ser mayor a 0.');
				$( "#guardar" ).show();
      			return false;
      		}

      		if(parseInt($('#cantidad').val()) > parseInt($('#stockactual').val()))
      		{
				toastr.error('La cantidad ingresada no puede ser mayor al stock de Producción.');
				$( "#guardar" ).show();
      			return false;
      		}


      		

		   	$('#form').submit();

		});



	</script>

@endpush