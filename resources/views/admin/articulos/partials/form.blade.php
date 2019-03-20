
<input type="hidden" name="listado_precios" id="id_lista_precios">
<input type="hidden" name="listado_familiares" id="id_lista_familiares">
<div class="row">
	<div class="col-md-12">	
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Ingrese</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
		      
				  	<div class="form-group">
					  	{{ form::label('id', 'Nro Articulo') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly'=> 'readonly']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('tipoarticulo_id', 'Tipo de Articulo') }}
						{{ form::select('tipoarticulo_id', $tipoarticulos, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
				  	</div>
				  	<div class="form-group" id="razonsocial">
					  	{{ form::label('descripcion', 'Descripción *') }}
						{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion', 'placeholder'=> 'Descripción', 'maxlength' =>'200']) }}
						<div id="clientespan" class="form-group has-error"style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
				  	</div>
				  	<div class="form-group" id="capacidad_medida">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td> 
											{{ form::label('capacidad', 'Capacidad *') }}
											{{ form::text('Capacidad', null, ['class' => 'form-control', 'id' => 'Capacidad', 'placeholder'=> 'Capacidad', 'maxlength' =>'200']) }}
											<div id="apellidospan" class="form-group has-error" style="display: none">
												<span class="help-block">Campo Obligatorio</span>
											</div>
											
										</td>
										<td> 
											{{ form::label('medida', 'Medida *') }}
											{{ form::select('medida', [1 => 'Litros'], null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
											<div id="nombrespan" class="form-group has-error"  style="display: none">
												<span class="help-block">Campo Obligatorio</span>
											</div>
										</td>
									</tr>
								</thead>
							</table>
						</div>
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('tipoenvase_id', 'Tipo de Envase') }}
						{{ form::select('tipoenvase_id', [], null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
				  	</div>	
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-mobile-phone"></i>-->

			      <h3 class="box-title">Clasificación</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      		<div class="form-group">
						{{-- {{ form::label('calsifcacion', 'Clasificación:') }} --}}
						<label>
							{{ Form::radio('calsifcacion','Venta')}} Venta
						</label>
						<label class="pull-right">
							{{ Form::radio('calsifcacion','scargo')}} Sin Cargo
						</label>
					</div>
					<hr>

					@if(! empty($articulo->file))
						<div class="form-group">
							<p> <strong>Seleccione una imagen:</strong></p>
						    <img src="{{ asset($articulo->file) }}" height="250" width="250" class="profile_img">
						</div>
						<div class="form-group">
							{{ form::label('eliminarimagen', 'Eliminar Logo') }}	
							<label>
								{{ Form::checkbox('eliminarimagen','on')}} 
							</label>
						</div>
					@else
						<div class="form-group" >
							<p> <strong>Seleccione una imagen:</strong></p>
						    <img src="{{ asset('imagedefeult/bidon_default.png') }}" height="230" width="250" class="profile_img">						    
						</div>

					@endif

					<hr>
					<div class="form-group">
						{{ Form::file('image') }}
					</div>

			      
			    </div>
			</div>

	 	</div>
	    <!-- /.box-body -->
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

<!--      segundo div general                              -->


		<div class="col-md-12">	
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Ingrese un precio:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
		      
				  	<div class="form-group">
				<div class="table-responsive">
					<table class="table table-striped table-hover" data-form="Form">
						<thead>
							<tr>
								<td> 
									{{ form::label('tipoprecio_id', 'Tipo Precio') }}
									{{ form::select('tipoprecio_id', [],  null, ['class' => 'form-control', 'id' => 'tipoprecio_id','placeholder' => 'Seleccionar...'] ) }}
								</td>
								<td> 
									{{ form::label('precio', 'Precio') }}
									{{ form::number('precio', null, ['class' => 'form-control', 'id' => 'precio']) }}
								</td>
								<td> 
									<br>
									<a type="button" id="agregarprecios" name="agregarprecios" class="btn btn btn-success">
					                    <span class="fa fa-plus-circle">
					                    </span>
					                    AGREGAR
					                </a>
								</td>
							</tr>		
						</thead>
					</table>
				</div>
				<div class="form-group">
					<div class="table-responsive">
						<table   id="table_precios" class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
								<!--<th width="10px"> ID</th>-->
									<th style="display:none;">Codigo</th>
									<th> Tipo Precio</th>
									<th> Precio</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-mobile-phone"></i>-->

			      <h3 class="box-title">Otros impuestos:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      	<div class="form-group">
					  	{{ form::label('costo', 'Consto') }}
						{{ form::number('costo', null, ['class' => 'form-control', 'id' => 'costo']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('costovendedor', 'C. Vendedor') }}
						{{ form::number('costovendedor', null, ['class' => 'form-control', 'id' => 'costovendedor']) }} 
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('costorepartidor', 'C. Repartidor') }}
						{{ form::number('costorepartidor', null, ['class' => 'form-control', 'id' => 'costorepartidor']) }}
				  	</div>
				  	<div class="form-group">
					  	{{ form::label('porcentajeiva', 'Con. IVA') }}
						{{ form::number('porcentajeiva', null, ['class' => 'form-control', 'id' => 'porcentajeiva']) }}
				  	</div>
			      
			    </div>
			</div>

	 	</div>
	    <!-- /.box-body -->
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
	 <!-- tercer div general -->

	

<!-- cuarta seccion-->

	<div class="col-md-12">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-users"></i>

	      <h3 class="box-title">Ingresar articulos al plan</h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="form-group">
				<div class="table-responsive">
					<table class="table table-striped table-hover" data-form="Form">
						<thead>
							<tr>
								<td> 
									{{ form::label('articulo_id', 'Vinculo') }}
									{{ form::select('articulo_id', [],  null, ['class' => 'form-control', 'id' => 'articulo_id','placeholder' => 'Seleccionar...'] ) }}
								</td>
								<td> 
									{{ form::label('nombrefamiliar', 'Apellido y Nombre') }}
									{{ form::text('nombrefamiliar', null, ['class' => 'form-control', 'id' => 'nombrefamiliar', 'maxlength' =>'200']) }}
								</td>
								<td> 
									{{ form::label('contactofamiliar', 'Contacto') }}
									{{ form::number('contactofamiliar', null, ['class' => 'form-control', 'id' => 'contactofamiliar']) }}
								</td>
								<td> 
									<br>
									<a type="button" id="agregarfamiliares" name="agregarfamiliares" class="btn btn btn-success">
					                    <span class="fa fa-plus-circle">
					                    </span>
					                    AGREGAR
					                </a>
								</td>
							</tr>		
						</thead>
					</table>
				</div>
				<div class="form-group">
					<div class="table-responsive">
						<table   id="table_familiares" class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
								<!--<th width="10px"> ID</th>-->
									<th style="display:none;"> Codigo</th>
									<th> Vinculo</th>
									<th> Apellido y Nombre</th>
									<th>Contacto</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
	    </div>
	  </div>
	</div>
</div>
	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		$( "#guardar" ).click(function() {


			$('#form').submit();
		
		});


	</script>

@endpush