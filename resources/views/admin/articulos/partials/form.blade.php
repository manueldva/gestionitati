
<input type="hidden" name="listado_direcciones" id="id_lista_direcciones">
<input type="hidden" name="listado_familiares" id="id_lista_familiares">
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
			      <i class="fa fa-mobile-phone"></i>

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
						<div class="form-group">
							<p> <strong>Seleccione una imagen:</strong></p>
						    <img src="{{ asset('imagedefeult/bidon_default.jpg') }}" height="230" width="250" class="profile_img">						    
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
	  	<div class="box-header with-border">
	      <i class="fa fa-home"></i>

	      <h3 class="box-title">
	      	Dirección Particular
	      </h3>

	      	<div id="direcciones1" class="form-group pull-right">
	          <label>
	            {{ Form::checkbox('direcciones1','1'), ['id'=>'direcciones1', 'name'=>'direcciones1']}} 
	          </label>  
	          &nbsp;
	           {{ form::label('direcciones1', ' Mas de una dirección') }}
	           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      </div>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <!-- /.box-header -->
			    <div class="box-body">


			      	<div class="form-group">
			      		<!--direccionid para validar cuando pasa de una direccion a otra -->
			      		@isset($cliente)
			      			{{ form::number('direcciones', null, ['class' => 'form-control', 'id' => 'direcciones', 'style' => 'display:none']) }}
			      		@else 
			      			{{ form::number('direcciones', 0, ['class' => 'form-control', 'id' => 'direcciones', 'style' => 'display:none']) }}
			      		@endif
			      		@isset($cliente)
			      			@if($cliente->direcciones == 0)
			      				{{ form::text('direccion_id', $clientedirecciones['0']['id'], ['class' => 'form-control', 'id' => 'direccion_id', 'maxlength' =>'500', 'style' => 'display:none']) }}
			      			@endif
			      		@else
			      			{{ form::text('direccion_id', 0, ['class' => 'form-control', 'id' => 'direccion_id', 'maxlength' =>'500', 'style' => 'display:none']) }}
			      		@endif
						{{ form::label('provincia_id', 'Provincia *') }}
						@isset($clientedirecciones)
							@if($cliente->direcciones == 0)
								{{ form::select('provincia_id',  isset($provincias) ? $provincias : [] ,  $clientedirecciones['0']['provincia_id'], ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
							@else
								{{ form::select('provincia_id',  isset($provincias) ? $provincias : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
							@endif
						@else
							{{ form::select('provincia_id',  isset($provincias) ? $provincias : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
						@endif
						<div id="provincia_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('departamento_id', 'Departamento *') }}
						@isset($clientedirecciones)
							@if($cliente->direcciones == 0)
								{{ form::select('departamento_id',  isset($departamentos) ? $departamentos : [] ,  $clientedirecciones['0']['departamento_id'], ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
							@else
								{{ form::select('departamento_id',  isset($departamentos) ? $departamentos : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
							@endif
						@else
							{{ form::select('departamento_id',  isset($departamentos) ? $departamentos : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
						@endif
						<div id="departamento_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('localidad_id', 'Localidad *') }}
						@isset($clientedirecciones)
							@if($cliente->direcciones == 0)
								{{ form::select('localidad_id',  isset($localidades) ? $localidades : [] ,  $clientedirecciones['0']['localidad_id'], ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
							@else
								{{ form::select('localidad_id',  isset($localidades) ? $localidades : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
							@endif
						@else
							{{ form::select('localidad_id',  isset($localidades) ? $localidades : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
						@endif
						{{ form::text('sinbarrio',  isset($sinbarrio) ? $sinbarrio : 0, ['class' => 'form-control', 'id' => 'sinbarrio']) }}
						<div id="localidad_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio *') }}
						@isset($clientedirecciones)
							@if($cliente->direcciones == 0)
								{{ form::select('barrio_id',  isset($barrios) ? $barrios : [] ,  $clientedirecciones['0']['barrio_id'], ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
							@else
								{{ form::select('barrio_id',  isset($barrios) ? $barrios : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
							@endif
						@else
							{{ form::select('barrio_id',  isset($barrios) ? $barrios : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
						@endif
						{{ form::text('sincalle', isset($sincalle) ? $sincalle : 0, ['class' => 'form-control', 'id' => 'sincalle']) }}
						<div id="barrio_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>

					<br>
					<div class="form-group">
						{{ form::label('calle_id', 'Calle *') }}
						@isset($clientedirecciones)
							@if($cliente->direcciones == 0)
								{{ form::select('calle_id',  isset($calles) ? $calles : [] ,  $clientedirecciones['0']['calle_id'], ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
							@else
								{{ form::select('calle_id',  isset($calles) ? $calles : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
							@endif
						@else
							{{ form::select('calle_id',  isset($calles) ? $calles : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
						@endif
						<div id="calle_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
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
			  
			    <!-- /.box-header -->
			    <div class="box-body">
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td > 
											{{ form::label('numero', 'Numero') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::number('numero', $clientedirecciones['0']['numero'], ['class' => 'form-control', 'id' => 'numero', 'max'=>'999999999']) }}
												@else
													{{ form::number('numero', null, ['class' => 'form-control', 'id' => 'numero', 'max'=>'999999999']) }}
												@endif
											@else
													{{ form::number('numero', null, ['class' => 'form-control', 'id' => 'numero', 'max'=>'999999999']) }}
											@endif
										</td>
										<td> 
											{{ form::label('codigopostal', 'Codigo Postal') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::number('codigopostal', $clientedirecciones['0']['codigopostal'], ['class' => 'form-control', 'id' => 'codigopostal', 'max'=>'999999999']) }}
												@else
													{{ form::number('codigopostal', null, ['class' => 'form-control', 'id' => 'codigopostal', 'max'=>'999999999']) }}
												@endif
											@else
													{{ form::number('codigopostal', null, ['class' => 'form-control', 'id' => 'codigopostal', 'max'=>'999999999']) }}
											@endif
										</td>
									</tr>
									
									<tr>
										<td> 
											{{ form::label('manzana', 'Manzana') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('manzana', $clientedirecciones['0']['manzana'], ['class' => 'form-control', 'id' => 'manzana', 'maxlength' =>'10']) }}
												@else
													{{ form::text('manzana', null, ['class' => 'form-control', 'id' => 'manzana', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('manzana', null, ['class' => 'form-control', 'id' => 'manzana', 'maxlength' =>'10']) }}
											@endif	
	
										</td>
										<td> 
											{{ form::label('casa', 'Casa') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('casa', $clientedirecciones['0']['casa'], ['class' => 'form-control', 'id' => 'casa', 'maxlength' =>'10']) }}
												@else
													{{ form::text('casa', null, ['class' => 'form-control', 'id' => 'casa', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('casa', null, ['class' => 'form-control', 'id' => 'casa', 'maxlength' =>'10']) }}
											@endif	
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('edificiotorre', 'Edificio/Torre') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('edificiotorre', $clientedirecciones['0']['edificiotorre'], ['class' => 'form-control', 'id' => 'edificiotorre', 'maxlength' =>'10']) }}
												@else
													{{ form::text('edificiotorre', null, ['class' => 'form-control', 'id' => 'edificiotorre', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('edificiotorre', null, ['class' => 'form-control', 'id' => 'edificiotorre', 'maxlength' =>'10']) }}
											@endif	
										</td>
										<td> 
											{{ form::label('piso', 'Piso/Dpto') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('piso', $clientedirecciones['0']['piso'], ['class' => 'form-control', 'id' => 'piso', 'maxlength' =>'10']) }}
												@else
													{{ form::text('piso', null, ['class' => 'form-control', 'id' => 'piso', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('piso', null, ['class' => 'form-control', 'id' => 'piso', 'maxlength' =>'10']) }}
											@endif	
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('seccion', 'Seccion') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('seccion', $clientedirecciones['0']['seccion'], ['class' => 'form-control', 'id' => 'seccion', 'maxlength' =>'10']) }}
												@else
													{{ form::text('seccion', null, ['class' => 'form-control', 'id' => 'seccion', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('seccion', null, ['class' => 'form-control', 'id' => 'seccion', 'maxlength' =>'10']) }}
											@endif	
										</td>
										<td> 
											{{ form::label('lote', 'Lote') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::text('lote', $clientedirecciones['0']['lote'], ['class' => 'form-control', 'id' => 'lote', 'maxlength' =>'10']) }}
												@else
													{{ form::text('lote', null, ['class' => 'form-control', 'id' => 'lote', 'maxlength' =>'10']) }}
												@endif
											@else
												{{ form::text('lote', null, ['class' => 'form-control', 'id' => 'lote', 'maxlength' =>'10']) }}
											@endif	
										</td>
									</tr>

									<tr>
										<td>
											{{ form::label('referenciadomicilio', 'Referencia') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::textarea('referenciadomicilio',  $clientedirecciones['0']['referenciadomicilio'], ['class' => 'form-control', 'id'=>'referenciadomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
												@else
													{{ form::textarea('referenciadomicilio', null, ['class' => 'form-control', 'id'=>'referenciadomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
												@endif
											@else
												{{ form::textarea('referenciadomicilio', null, ['class' => 'form-control', 'id'=>'referenciadomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
											@endif


										</td>
										<td>
											{{ form::label('observaciondomicilio', 'Observacion') }}
											@isset($clientedirecciones)
												@if($cliente->direcciones == 0)
													{{ form::textarea('observaciondomicilio',  $clientedirecciones['0']['observaciondomicilio'], ['class' => 'form-control', 'id'=>'observaciondomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
												@else
													{{ form::textarea('observaciondomicilio', null, ['class' => 'form-control', 'id'=>'observaciondomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
												@endif
											@else
												{{ form::textarea('observaciondomicilio', null, ['class' => 'form-control', 'id'=>'observaciondomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
											@endif
											{{ form::text('cargarobservacion', 0, ['class' => 'form-control', 'id' => 'cargarobservacion', 'maxlength' =>'500']) }}
											<div id="cargarobservacionspan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
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
				    <div class="box-header with-border">
				      <i class="fa fa-user"></i>

				      <h3 class="box-title">Datos del Vendedor</h3>
				    </div>
			    	<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td class="col-md-3"> 
										{{ form::label('empleado_id', 'Cod. *') }}
										@isset($clientedirecciones)
											@if($cliente->direcciones == 0)
												{{ form::number('empleado_id', $clientedirecciones['0']['empleado_id'], ['class' => 'form-control', 'id' => 'empleado_id', 'max'=>'999999999']) }}
											@else
												{{ form::number('empleado_id', null, ['class' => 'form-control', 'id' => 'empleado_id', 'max'=>'999999999']) }}
											@endif
										@else
												{{ form::number('empleado_id', null, ['class' => 'form-control', 'id' => 'empleado_id', 'max'=>'999999999']) }}
										@endif
										<div id="empleado_idspan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
										<br>
										{{ form::label('movil', 'Tipo Movil') }}
										{{ form::text('movil', null, ['class' => 'form-control', 'id' => 'movil', 'readonly' => 'readonly']) }}
										
									</td>
									<td> 
										{{ form::label('empleado', 'vendedor') }}
										<br>
										{{ form::select('empleado',[],  null, ['class' => 'form-control inline-search', 'id' => 'empleado','placeholder' => 'Seleccionar...'] ) }}
										<div id="empleadospan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
										<br>
										{{ form::label('patente', 'Patente') }}
										{{ form::text('patente', null, ['class' => 'form-control', 'id' => 'patente', 'readonly' => 'readonly']) }}
									</td>
									<td> 
										{{ form::label('horariovisita', 'visita') }}
										@isset($clientedirecciones)
											@if($cliente->direcciones == 0)
												{{ form::select('horariovisita', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  $clientedirecciones['0']['horariovisita'], ['class' => 'form-control', 'id' => 'horariovisita','placeholder' => 'Seleccionar...'] ) }}
											@else
												{{ form::select('horariovisita', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  null, ['class' => 'form-control', 'id' => 'horariovisita','placeholder' => 'Seleccionar...'] ) }}
											@endif
										@else
											{{ form::select('horariovisita', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  null, ['class' => 'form-control', 'id' => 'horariovisita','placeholder' => 'Seleccionar...'] ) }}
										@endif
									</td>
									<td>
										{{ form::label('horadesde', 'Desde') }}
										@isset($clientedirecciones)
											@if($cliente->direcciones == 0)
												{{ form::time('horadesde', $clientedirecciones['0']['horadesde'], ['class' => 'form-control', 'id' => 'horadesde']) }}
											@else
												{{ form::time('horadesde', null, ['class' => 'form-control', 'id' => 'horadesde']) }}
											@endif
										@else
											{{ form::time('horadesde', null, ['class' => 'form-control', 'id' => 'horadesde']) }}
										@endif
										</div>
									</td>
									<td> 
										{{ form::label('horahasta', 'Hasta') }}
										@isset($clientedirecciones)
											@if($cliente->direcciones == 0)
												{{ form::time('horahasta', $clientedirecciones['0']['horahasta'], ['class' => 'form-control', 'id' => 'horahasta']) }}
											@else
												{{ form::time('horahasta', null, ['class' => 'form-control', 'id' => 'horahasta']) }}
											@endif
										@else
											{{ form::time('horahasta', null, ['class' => 'form-control', 'id' => 'horahasta']) }}
										@endif
										</div>
									</td>
								</tr>	
							</thead>
						</table>
					</div>
			    </div>
			    <div class="form-group pull-right">
				    <a type="button" id="agregardireccion" name="agregardireccion" class="btn btn btn-success">
	                    <span class="fa fa-plus-circle">
	                    </span>
	                    Agregar Dirección
	                </a>
	            </div>
	            <br>
	            <br>
	            <br>

			    <div class="form-group pull">
					<div class="table-responsive">
						<table   id="table_direcciones" class="table table-striped table-hover" style="display:none" data-form="Form">
							<thead>
								<tr>
								<!--<th width="10px"> ID</th>-->
									<th style="display:none;"> provincia</th>
									<th style="display:none;"> departamento</th>
									<th style="display:none;"> localidad</th>
									<th> Barrio</th>
									<th> Calle</th>
									<th> Numero</th>
									<th> Manzana</th>
									<th> Casa</th>
									<th>Edificio/Torre</th>
									<th> piso/Dpto</th>
									<th> Seccion</th>
									<th> Lote</th>
									<th style="display:none;"> Codigopostal</th>
									<th style="display:none;"> Referencia</th>
									<th style="display:none;"> Observacion</th>
									<th style="display:none;"> empleado_id</th>
									<th style="display:none;"> horariovisita</th>
									<th style="display:none;"> horadesde</th>
									<th style="display:none;"> horahasta</th>
									<th style="display:none;"> barrio_id</th>
									<th style="display:none;"> calle_id</th>
									<th style="display:none;"> direccion_id</th>
									<th> Vendedor</th>

								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						<div id="table_direccionesspan" class="form-group has-error" style="display: none">
							<span class="help-block">Debe haber al menos un registro en la lista</span>
						</div>
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
									{{ form::label('tipofamiliar_id', 'Vinculo') }}
									{{ form::select('tipofamiliar_id', [],  null, ['class' => 'form-control', 'id' => 'tipofamiliar_id','placeholder' => 'Seleccionar...'] ) }}
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