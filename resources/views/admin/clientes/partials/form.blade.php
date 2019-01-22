

<div class="row">
	<div class="col-md-12">
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <i class="fa fa-user"></i>

			      <h3 class="box-title">Datos Personales</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="form-group">
			      	{{ form::label('id', 'Codigo Cliente') }}
					{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly'=> 'readonly']) }}
			      </div>
			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('tipodocumento_id', 'Tipo de Documento') }}
										{{ form::select('tipodocumento_id', isset($tipodocumentos) ? $tipodocumentos : [], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
									</td>
									<td> 
										{{ form::label('numerodocumento', 'Nro Docuemento *') }}
										{{ form::number('numerodocumento', null, ['class' => 'form-control', 'id' => 'numerodocumento']) }}
									</td>
								</tr>
							</thead>
						</table>
					</div>
				  </div>
			      <div class="form-group">
					{{ form::label('tipocliente_id', 'Tipo de Cliente *') }}
					{{ form::select('tipocliente_id', isset($tipoclientes) ? $tipoclientes : [], null, ['class' => 'form-control'] ) }} 
				  </div>
			      <div class="form-group">
			      	{{ form::label('cliente', 'Cliente *') }}
					{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'placeholder'=> 'Apellido y Nombre / Razon Social']) }}
			      </div>
			      <div class="form-group">
			      	{{ form::label('referente', 'Referente') }}
					{{ form::text('referente', null, ['class' => 'form-control', 'id' => 'referente', 'placeholder'=> 'Representante de la entidad', 'readonly' => 'readonly']) }}
			      </div>
			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('fechanacimiento', 'Fecha de Nacimiento') }}
										{{ form::date('fechanacimiento', null, ['class' => 'form-control', 'id' => 'fechanacimiento']) }}
									</td>
									<td> 
										{{ form::label('edad', 'Edad') }}
										{{ form::text('edad', null, ['class' => 'form-control', 'id' => 'edad', 'readonly' => 'readonly']) }}
									</td>
								</tr>	
								<tr>
									<td> 
										{{ form::label('tipoiva_id', 'Concidicion IVA') }}
										{{ form::select('tipoiva_id', isset($tipoivas) ? $tipoivas : [], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
									</td>
									<td> 
										{{ form::label('cuit', 'Cuit *') }}
										{{ form::text('cuit', null, ['class' => 'form-control', 'id' => 'cuit']) }}
									</td>
								</tr>	
								<tr>
									<td> 
										{{ form::label('estado', 'Estado') }}
										{{ form::select('estado', [1 => 'Activo', 0 => 'Inactivo'], null, ['class' => 'form-control'] ) }}
									</td>
									<td> 
										{{ form::label('motivo', 'Motivo') }}
										{{ form::text('motivo', null, ['class' => 'form-control', 'id' => 'motivo', 'readonly' => 'readonly']) }}
									</td>
								</tr>	
								<tr>
									<td> 
										
									</td>
									<td style="text-align:right;"> 
										{{ form::label('sincargo', 'Cliente Sin Cargo') }}
										<label>
											{{ Form::checkbox('sincargo','1')}} 
										</label>
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

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      <i class="fa fa-shopping-cart"></i>

			      <h3 class="box-title">Articulos en posesión del cliente</h3>
			    </div
			    <!-- /.box-header -->
			    <div class="box-body">

			     	<div class="form-group">
						{{ form::label('articulo', 'Buscar Articulo *') }}
						{{ form::select('articulo', [],  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::text('descripcionarticulo', null	, ['class' => 'form-control', 'id' => 'descripcionarticulo',  'style'=> 'display: none']) }}	
					</div>
					<div class="form-group">
						{{ form::text('stockarticulo', null	, ['class' => 'form-control', 'id' => 'stockarticulo',  'style'=> 'display: none']) }}	
					</div>
					<div class="form-group">
						{{ form::text('articulo_id', null	, ['class' => 'form-control', 'id' => 'articulo_id',  'style'=> 'display: none']) }}	
					</div>
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('cantidadarticulo', 'Cantidad') }}
										{{ form::number('cantidadarticulo', null, ['class' => 'form-control', 'id' => 'cantidadarticulo']) }}
									</td>
									<td> 
										<br>
										<a type="button" id="agregararticulo" name="agregararticulo" class="btn btn btn-success">
						                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
						                    <span class="fa fa-plus-circle">
						                    </span>
						                      AGREGAR
						                  </a>
									</td>
								</tr>	
								
							</thead>
						</table>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_articulos" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Articulo</th>
											<th> Cantidad</th>
											<th> </th>
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
			    <!-- /.box-body -->
			</div>

	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

<!--      segundo div general                              -->


	<div class="col-md-12">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-home"></i>

	      <h3 class="box-title">Dirección Particular</h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <!-- /.box-header -->
			    <div class="box-body">
			      	<div class="form-group">
						{{ form::label('provincia_id', 'Provincia') }}
						{{ form::select('provincia_id',  isset($provincias) ? $provincias : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('localidad_id', 'Localidad') }}
						{{ form::select('localidad_id', isset($cliente) ? $localidades : [],  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio') }}
						{{ form::select('barrio_id', isset($cliente) ? $barrios : [],  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('calle_id', 'Calle ') }}
						{{ form::select('calle_id', isset($cliente) ? $calles : [],  null, ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
			     
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			  
			    <!-- /.box-header -->
			    <div class="box-body">
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td> 
											{{ form::label('numero', 'Numero') }}
											{{ form::number('numero', null, ['class' => 'form-control', 'id' => 'numero']) }}
										</td>
										<td> 
											{{ form::label('codigopostal', 'Codigo Postal') }}
											{{ form::number('codigopostal', null, ['class' => 'form-control', 'id' => 'codigopostal']) }}
										</td>
									</tr>	

									<tr>
										<td> 
											{{ form::label('manzana', 'Manzana') }}
											{{ form::text('manzana', null, ['class' => 'form-control', 'id' => 'manzana']) }}
										</td>
										<td> 
											{{ form::label('casa', 'Casa') }}
											{{ form::text('casa', null, ['class' => 'form-control', 'id' => 'casa']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('edificiotorre', 'Edificio/Torre') }}
											{{ form::text('edificiotorre', null, ['class' => 'form-control', 'id' => 'edificiotorre']) }}
										</td>
										<td> 
											{{ form::label('piso', 'Piso') }}
											{{ form::text('piso', null, ['class' => 'form-control', 'id' => 'piso']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('seccion', 'Seccion') }}
											{{ form::number('seccion', null, ['class' => 'form-control', 'id' => 'seccion']) }}
										</td>
										<td> 
											{{ form::label('lote', 'Lote') }}
											{{ form::number('lote', null, ['class' => 'form-control', 'id' => 'lote']) }}
										</td>
									</tr>	
								</thead>
							</table>
						</div>
					</div>	
				</div>

			</div>
			    <!-- /.box-body -->
			<div class="col-md-10">
			    <div class="box-body">
			    	<hr>
			      	<div class="form-group">
						{{ form::label('observaciondomicilio', 'Observacion') }}
						{{ form::text('observaciondomicilio', null, ['class' => 'form-control', 'id' => 'observaciondomicilio']) }}
					</div>
			    </div>
			</div>
	    </div>
			  <!-- /.box -->
			<!--</div>-->
			<!-- /.col -->
	  </div>
	    <!-- /.box-body -->
	</div>
	  <!-- /.box -->

	 <!-- tercer div general -->

	<div class="col-md-12">
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <i class="fa fa-mobile-phone"></i>

			      <h3 class="box-title">Contacto</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="form-group">
					{{ form::label('telefonoparticular', 'Telefono Particulo') }}
					{{ form::number('telefonoparticular', null, ['class' => 'form-control', 'id' => 'telefonoparticular']) }}
				  </div>

			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('celular', 'Celular') }}
										{{ form::number('celular', null, ['class' => 'form-control', 'id' => 'celular']) }}
									</td>
									<td> 
										{{ form::label('companiatelefonica_id', 'Proveedor') }}
										{{ form::select('companiatelefonica_id', $companiatelefonicas, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
									</td>
								</tr>		
								
							</thead>
						</table>
					</div>
				  </div>	
			      <div class="form-group">
			      	{{ form::label('email', 'Email') }}
					{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> 'juan@gmail.com']) }}
			      </div>
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-5">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      <i class="fa fa-user"></i>

			      <h3 class="box-title">Datos del Vendedor</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
				  <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td class="col-md-3"> 
										{{ form::label('codigovendedor', 'Codigo V.') }}
										{{ form::number('codigovendedor', null, ['class' => 'form-control', 'id' => 'codigovendedor']) }}
									</td>
									<td> 
										{{ form::label('empleado', 'Vendedor') }}
										<br>
										{{ form::select('empleado', [],  null, ['class' => 'form-control inline-search', 'id' => 'empleado','placeholder' => 'Seleccionar...'] ) }}
										
									</td>
								</tr>	
							</thead>
						</table>
					</div>
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td>
											{{ form::label('movil', 'Tipo Movil') }}
											{{ form::text('movil', null, ['class' => 'form-control', 'id' => 'movil', 'readonly' => 'readonly']) }}
										</td>
										<td> 
											{{ form::label('patente', 'Patente') }}
											{{ form::text('patente', null, ['class' => 'form-control', 'id' => 'patente', 'readonly' => 'readonly']) }}
										</td>
									</tr>	
									
								</thead>
							</table>
						</div>
				  	</div>

				  	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td> 
											{{ form::label('horariovisita', 'visita') }}
											{{ form::select('horariovisita', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  null, ['class' => 'form-control', 'id' => 'horariovisita','placeholder' => 'Seleccionar...'] ) }}
										</td>
										<td>
											{{ form::label('horadesde', 'Desde') }}
											{{ form::time('horadesde', null, ['class' => 'form-control', 'id' => 'horadesde']) }}
											</div>
										</td>
										<td> 
											{{ form::label('horahasta', 'Hasta') }}
											{{ form::time('horahasta', null, ['class' => 'form-control', 'id' => 'horahasta']) }}
											</div>
										</td>
									</tr>	
									
								</thead>
							</table>
						</div>
				  	</div>
				 
			    </div>
			    <!-- /.box-body -->
			</div>
			
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>

<!-- cuarta seccion-->


	</div>
	<div class="col-md-12">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-users"></i>

	      <h3 class="box-title">Familiar Asociado</h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="form-group">
				<div class="table-responsive">
					<table class="table table-striped table-hover" data-form="Form">
						<thead>
							<tr>
								<td> 
									{{ form::label('vinculo_id', 'Vinculo') }}
									{{ form::select('vinculo_id', ['1' => 'Esposa', '2' => 'Esposo', '3' => 'Hijo/a' ],  null, ['class' => 'form-control', 'id' => 'vinculo_id','placeholder' => 'Seleccionar...'] ) }}
								</td>
								<td> 
									{{ form::label('nombrevinculo', 'Apellido y Nombre') }}
									{{ form::text('nombrevinculo', null, ['class' => 'form-control', 'id' => 'nombrevinculo']) }}
								</td>
								<td> 
									{{ form::label('contactovinculo', 'Contacto') }}
									{{ form::number('contactovinculo', null, ['class' => 'form-control', 'id' => 'contactovinculo']) }}
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

	<script src="{{ asset('js/admin/clientes/form.js') }}"></script>

@endpush