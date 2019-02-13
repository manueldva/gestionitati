
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
										{{ form::select('tipodocumento_id', isset($tipodocumentos) ? $tipodocumentos : [], null, ['class' => 'form-control'] ) }} 
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
			      <div class="form-group" id="razonsocial">
			      	{{ form::label('cliente', 'Razon Social *') }}
					{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'placeholder'=> 'Razon Social', 'maxlength' =>'200']) }}
					<div id="clientespan" class="form-group has-error"style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
			      </div>
			      <div class="form-group" id="apellidoynombre">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('apellido', 'Apellido *') }}
										{{ form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido', 'placeholder'=> 'Apellido', 'maxlength' =>'200']) }}
										<div id="apellidospan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
										
									</td>
									<td> 
										{{ form::label('nombre', 'Nombre *') }}
										{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre', 'placeholder'=> 'Nombre', 'maxlength' =>'200']) }}
										<div id="nombrespan" class="form-group has-error"  style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
									</td>
								</tr>
							</thead>
						</table>
					</div>
				  </div>

			      <div class="form-group" id="referentes">
			      	{{ form::label('referente', 'Referente *') }}
					{{ form::text('referente', null, ['class' => 'form-control', 'id' => 'referente', 'placeholder'=> 'Representante de la entidad', 'maxlength' =>'150']) }}
					<div id="referentespan" class="form-group has-error"  style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
			      </div>
			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								</tr>	
									<td>
										 <div  id = "tipoivas">
								      		{{ form::label('tipoiva_id', 'Concidicion IVA') }}
											{{ form::select('tipoiva_id', isset($tipoivas) ? $tipoivas : [], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
								      	</div>
							  		</td>
							  		<td>
							  			
							  		</td>
							     </tr>
								<tr>
									<td> 
										{{ form::label('estado', 'Estado') }}
										{{ form::select('estado', [1 => 'Activo', 0 => 'Inactivo'], null, ['class' => 'form-control'] ) }}
									</td>
									<td> 
										{{ form::label('motivoestado', 'Motivo') }}
										{{ form::text('motivoestado', null, ['class' => 'form-control', 'id' => 'motivoestado']) }}
									</td>
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

	      <h3 class="box-title">
	      	Dirección Particular
	      </h3>
	      <div id="direcciones" class="form-group pull-right">
	          <label>
	            {{ Form::checkbox('direcciones','1'), ['id'=>'direcciones', 'name'=>'direcciones']}} 
	          </label>  
	          &nbsp;
	           {{ form::label('direcciones', ' Mas de una dirección') }}
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
						{{ form::label('provincia_id', 'Provincia *') }}
						{{ form::select('provincia_id',  isset($provincias) ? $provincias : [] ,  null, ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
						<div id="provincia_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('departamento_id', 'Departamento *') }}
						{{ form::select('departamento_id', isset($cliente) ? $departamentos : [],  null, ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
						<div id="departamento_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('localidad_id', 'Localidad *') }}
						{{ form::select('localidad_id', isset($cliente) ? $localidades : [],  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
						{{ form::text('sinbarrio',  isset($sinbarrio) ? $sinbarrio : 0, ['class' => 'form-control', 'id' => 'sinbarrio']) }}
						<div id="localidad_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio *') }}
						{{ form::select('barrio_id', isset($cliente) ? $barrios : [],  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
						{{ form::text('sincalle', isset($sincalle) ? $sincalle : 0, ['class' => 'form-control', 'id' => 'sincalle']) }}
						<div id="barrio_idspan" class="form-group has-error" style="display: none">
							<span class="help-block">Campo Obligatorio</span>
						</div>
					</div>

					<br>
					<div class="form-group">
						{{ form::label('calle_id', 'Calle *') }}
						{{ form::select('calle_id', isset($cliente) ? $calles : [],  null, ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
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
											{{ form::number('numero', null, ['class' => 'form-control', 'id' => 'numero', 'max'=>'999999999']) }}
										</td>
										<td> 
											{{ form::label('codigopostal', 'Codigo Postal') }}
											{{ form::number('codigopostal', null, ['class' => 'form-control', 'id' => 'codigopostal', 'max' =>'999999999']) }}
										</td>
									</tr>
									
									<tr>
										<td> 
											{{ form::label('manzana', 'Manzana') }}
											{{ form::text('manzana', null, ['class' => 'form-control', 'id' => 'manzana', 'maxlength' =>'10']) }}
										</td>
										<td> 
											{{ form::label('casa', 'Casa') }}
											{{ form::text('casa', null, ['class' => 'form-control', 'id' => 'casa', 'maxlength' =>'10']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('edificiotorre', 'Edificio/Torre') }}
											{{ form::text('edificiotorre', null, ['class' => 'form-control', 'id' => 'edificiotorre', 'maxlength' =>'10']) }}
										</td>
										<td> 
											{{ form::label('piso', 'Piso') }}
											{{ form::text('piso', null, ['class' => 'form-control', 'id' => 'piso', 'maxlength' =>'10']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('seccion', 'Seccion') }}
											{{ form::text('seccion', null, ['class' => 'form-control', 'id' => 'seccion', 'maxlength' =>'10']) }}
										</td>
										<td> 
											{{ form::label('lote', 'Lote') }}
											{{ form::text('lote', null, ['class' => 'form-control', 'id' => 'lote', 'maxlength' =>'10']) }}
										</td>
									</tr>

									<tr>
										<td>
											{{ form::label('referenciadomicilio', 'Referencia') }}
											{{ form::textarea('referenciadomicilio', null, ['class' => 'form-control', 'id'=>'referenciadomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
										</td>
										<td>
											{{ form::label('observaciondomicilio', 'Observacion') }}
											{{ form::textarea('observaciondomicilio', null, ['class' => 'form-control', 'id'=>'observaciondomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
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
										{{ form::number('empleado_id', null, ['class' => 'form-control', 'id' => 'empleado_id']) }}
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
										{{ form::select('empleado',$empleados,  null, ['class' => 'form-control inline-search', 'id' => 'empleado','placeholder' => 'Seleccionar...'] ) }}
										<div id="empleadospan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
										<br>
										{{ form::label('patente', 'Patente') }}
										{{ form::text('patente', null, ['class' => 'form-control', 'id' => 'patente', 'readonly' => 'readonly']) }}
									</td>
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
									<th> piso</th>
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
									{{ form::select('tipofamiliar_id', $tipofamiliar,  null, ['class' => 'form-control', 'id' => 'tipofamiliar_id','placeholder' => 'Seleccionar...'] ) }}
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
								@if($editshow !== 0)
									@foreach ($clientefamiliares as $clientefamiliar)
					                  <tr>
					                    <td style="display:none;">{{ $clientefamiliar->tipofamiliar_id }}</td>
					                    <td>{{ $clientefamiliar->tipofamiliar->descripcion }}</td>
										<td>{{ $clientefamiliar->nombre }}</td>
										<td>{{ $clientefamiliar->contacto }}</td>
					                    @if($editshow == 1) 
						                    <td>
							                   <a class='delete btn btn-sm btn-danger' onclick ='deletefamiliar_row($(this))'>
							                   	<span class='glyphicon glyphicon-trash'></span>
							                   </a>
						               	    </td>
					                    @endif
					                  </tr>
					                @endforeach
								@endif
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

		/*
		editshow
		0= create
		1= edit
		2= show
		*/
		// para cargar datos si es editar o mostrar 
		var editshow = {!! json_encode($editshow) !!};
		if(editshow !== 0){
			buscarEmpleado();
		}

		var APP_RL = "{{ url('/') }}";

		$("#sincalle").hide();		
		$("#sinbarrio").hide();
		$("#cargarobservacion").hide();
		
		//para direcciones
		var checkdirecciones = $("#direcciones").parent('[class*="icheckbox"]').hasClass("checked");
		if(checkdirecciones) {
  			$("#agregardireccion").show();
  			$("#table_direcciones").show();
		} else {
			$("#agregardireccion").hide();
			$("#table_direcciones").hide();
		}//


		/*de movida todo tiente que estar bloqueado*/
		if(editshow == 0){
			$(":input").prop("disabled", true);
			$("#tipodocumento_id").prop("disabled", false);
			$("#numerodocumento").prop("disabled", false);
		} else if(editshow == 2){
			$(":input").prop("disabled", true);
		} else if(editshow == 1){
			if($("#observaciondomicilio").val() !== '') {
				$("#observaciondomicilio").prop("disabled", false);
			}
		}
	
		//$('#articulo_id').select2();
		$('#provincia_id').select2();
		$('#departamento_id').select2();
		$('#localidad_id').select2();
		$('#barrio_id').select2();
		$('#calle_id').select2();

		/*para calcular edad a partir de una fecha de nacimientpo*/
		function calcularEdad() {
			FechaNacimiento = $('#fechanacimiento').val();
			var fechaNace = new Date(FechaNacimiento);
			var fechaActual = new Date();
			var mes = fechaActual.getMonth();
			var dia = fechaActual.getDate();
			var año = fechaActual.getFullYear();
			fechaActual.setDate(dia);
			fechaActual.setMonth(mes);
			fechaActual.setFullYear(año);
			edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));
			//return edad;
			if(!isNaN(edad)) {
				$('#edad').val(edad);
			}
			
		}

		calcularEdad();

		$('#fechanacimiento').focusout(function(e) {
			calcularEdad();
		});


		/*mostrar campos dependiendo del tipo del cliente*/
		function habilitarCliente(){
			var tipodoc = $('#tipodocumento_id').val();
			var tipocli = $('#tipocliente_id').val();
			if(tipodoc == 10){
				if(tipocli == 1){
					$('#tipocliente_id').val(2);
				}
			} else {
				if(tipocli == 2){
					$('#tipocliente_id').val(1);
				}
			}

			if ($("#tipocliente_id").val() == '1'){
				$("#razonsocial").hide();
				$("#apellidoynombre").show();
				$("#referentes").hide();
				//$("#tipoivas").hide();
				$("#cuits").hide();
				$("#fechanacimientos").show();
				$("#edades").show();
			} else {
				$("#razonsocial").show();
				$("#apellidoynombre").hide();
				$("#referentes").show();
				//$("#tipoivas").show();
				$("#cuits").show();
				$("#fechanacimientos").hide();
				$("#edades").hide();
			}

		}

		habilitarCliente();

		$('#tipocliente_id').change(function(e) {
			
			habilitarCliente();
		});

		/*recuper si existe cliente*/


		function verificarDocumento() {
			
			var estado = verificarlongitudnrocodumento();

			if(estado == false) return false;

			var nrodoc = $('#numerodocumento').val();
			var tipodoc = $('#tipodocumento_id').val();
			if (nrodoc !== '') {
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/validardocumento',
					//url: '../api/validardocumento',
					data: {q: nrodoc, t:tipodoc}
				}).done(function(data) {

					if(data !== 0) {
						/*if(parseInt($('#id').val()) !== parseInt(data)){
							swal({
							title: "El cliente ingresado ya existe",
							text: "Verefique los datos",
							type: "info",
							//showCancelButton: true,
							closeOnConfirm: true//,
							//showLoaderOnConfirm: true
							}, function () {
								window.location.replace(APP_URL + "/clientes/"+ data +"/edit");

							});
						}*/
						swal({ 
							title: "El cliente ingresado ya existe",
							text: "¿Desea recuperar los datos?",
							type: "info",
							showCancelButton: true,
							//confirmButtonColor: "#DD6B55",
							confirmButtonText: "OK",
							cancelButtonText: "Cancelar", 
							closeOnConfirm: false,
							closeOnCancel: false },

							function(isConfirm){ 
							if (isConfirm) {
								window.location.replace(APP_URL + "/clientes/"+ data +"/edit");
							} else { 
								$('#numerodocumento').focus();
								swal.close()
							} 
						});

					} else{
						toastr.success('Numero de documento no existente en la base de datos');
						$(":input").prop("disabled", false);
						$("#observaciondomicilio").prop("disabled", true);
						habilitarMotivoEstado();
						habilitarCliente();
					}
					
				});
			}
		}


		/*$('#numerodocumento').focusout(function(e) {
			 verificarDocumento();

		});*/

		$(document).ready(function(){
		    $("#numerodocumento").keypress(function(e) {
		        //no recuerdo la fuente pero lo recomiendan para
		        //mayor compatibilidad entre navegadores.
		        var code = (e.keyCode ? e.keyCode : e.which);
		        if(code==13){
		            verificarDocumento();

		        }
		    });
		});


		/* validar tipo documento*/
		$('#tipodocumento_id').on('change', function(e){
			habilitarCliente();
		   	$(":input").prop("disabled", true);
			$("#tipodocumento_id").prop("disabled", false);
			$("#numerodocumento").prop("disabled", false);
			/*$('#apellidospan').hide();
			$('#nombrespan').hide();*/

			var tipodocumento_id = $("#tipodocumento_id").val();

			if(tipodocumento_id < 5 || tipodocumento_id == 10 ) {
				$('#numerodocumento').val('');
				$('#numerodocumento').attr('type','number');
				$('#numerodocumento').focus();
			} else {
				$('#numerodocumento').attr('type','text');
				$('#numerodocumento').val('');
				$('#numerodocumento').focus();
			}

			
		});

		// estado
		function habilitarMotivoEstado(){
			var estado = $("#estado").val();
			if(estado == 1 ) {
				$("#motivoestado").prop( "disabled", true );
			} else {
				$("#motivoestado").prop( "disabled", false );
				$("#motivoestado").focus();
			}
		}

		habilitarMotivoEstado();
		
		$('#estado').on('change', function(e){
			habilitarMotivoEstado();
		});

		
		/*buscar empleado desde codigo*/
		function buscarEmpleado() {

			var empleado_id = $('#empleado_id').val();

			if (empleado_id == '') empleado_id = $('#empleado').val();

			if (empleado_id !== '') {
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/buscarempleado',
					//url: '../api/validardocumento',
					data: {q: empleado_id}
				}).done(function(data) {
					//var $empleado = $('#empleado'); 
					if(data !== 0) {
						$("#empleado_id").val(data.id);
						$("#patente").val(data.patente);
						$("#movil").val(data.movil);
						$("#empleado").val(data.id);
						//$("#patente").text(data.patente);


						//$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
						//toastr.info('Codigo de vendedor correcto');
					} else{
						$("#empleado_id").val('');
						$("#patente").val('');
						$("#movil").val('');
						$("#empleado").val('');

						
					}
					
				});
			} else {
				$("#empleado_id").val('');
				$("#patente").val('');
				$("#movil").val('');
				$("#empleado").val('');
			}
		}
		

		$('#empleado_id').focusout(function(e) {
			if ($('#empleado_id').val() == '') $('#empleado').val(''); 
			buscarEmpleado();

		});

		$(document).ready(function(){
		$("#empleado_id").keypress(function(e) {
				//no recuerdo la fuente pero lo recomiendan para
				//mayor compatibilidad entre navegadores.
				var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					if ($('#empleado_id').val() == '') $('#empleado').val(''); 
					buscarEmpleado();

				}
			});
		});

		$('#empleado').on('change', function(e){
			if ($('#empleado').val() == '') $('#empleado_id').val(''); 
			buscarEmpleado();
		});

		/*buscar empleado*/

		

		/*para agregar articulos al listado*/
		$( "#agregardireccion" ).click(function() {

			//toastr.error('funciona');
			if($('#articulo_id').val() == ''  || $("#cantidadarticulo").val() == '') {

				toastr.error('No se puede agregar este articulo. Faltan datos');
				return false;
			}

			//variables para guardar en la grilla
			var provincia_id = $('#provincia_id').val();
			var departamento_id = $('#departamento_id').val();
			var localidad_id = $('#localidad_id').val();
			var barrio_id = $('#barrio_id').val();
			var barrio = $('select[name="barrio_id"] option:selected').text();
			var calle_id = $('#calle_id').val();
			var calle = $('select[name="calle_id"] option:selected').text();
			var numero = $('#numero').val();
			var manzana = $('#manzana').val();
			var casa = $('#casa').val();
			var edificiotorre = $('#edificiotorre').val();
			var piso = $('#piso').val();
			var secccion = $('#seccion').val();
			var lote = $('#lote').val();
			var codigopostal = $('#codigopostal').val();
			var referencia = $('#referenciadomicilio').val();
			var observacion = $('#observaciondomicilio').val();
			var empleado_id = $('#empleado_id').val();
			var horariovisita = $('#horariovisita').val();
			var horadesde = $('#horadesde').val();
			var horasta = $('#horasta').val();
			var empleado = $('select[name="empleado"] option:selected').text();


			//cargo la grilla
			$('#table_direcciones tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + provincia_id + '</td>' +
				'<td style="display:none;">' + departamento_id + '</td>' +
				'<td style="display:none;">' + localidad_id + '</td>' +
				'<td>' + barrio + '</td>' +
				'<td>' + calle + '</td>' +
				'<td>' + numero + '</td>' +
				'<td>' + manzana + '</td>' +
				'<td>' + casa + '</td>' +
				'<td>' + edificiotorre + '</td>' +
				'<td>' + piso + '</td>' +
				'<td>' + secccion + '</td>' +
				'<td>' + lote + '</td>' +
				'<td style="display:none;">' + codigopostal + '</td>' +
				'<td style="display:none;">' + referencia + '</td>' +
				'<td style="display:none;">' + observacion + '</td>' +
				'<td style="display:none;">' + empleado_id + '</td>' +
				'<td style="display:none;">' + horariovisita + '</td>' +
				'<td style="display:none;">' + horadesde + '</td>' +
				'<td style="display:none;">' + horasta + '</td>' +
				'<td style="display:none;">' + barrio_id + '</td>' +
				'<td style="display:none;">' + calle_id + '</td>' +
				'<td>' + empleado + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletedireccion_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');

			toastr.success('Articulo agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletedireccion_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Direccion eliminada de la lista');
		}



		/*para combos de domicilio*/
		$('#provincia_id').on('change', function(e){
		    console.log(e);
		    var provincia_id = e.target.value;

		    $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

		      $('#departamento_id').empty();
		      $('#departamento_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			  $('#localidad_id').empty();
		      $('#localidad_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			  $('#barrio_id').empty();
		      $('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			  $('#calle_id').empty();
			  $('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

		      $.each(data, function(fetch, departamento){
		        console.log(data);
		        $('#departamento_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
		      })
		    });
		    /*id2 = $("#provincia_id option:selected").val();
		    cargar_departamentos(id2);*/
		});

		$('#departamento_id').on('change', function(e){
		    console.log(e);
		    var departamento_id = e.target.value;

		    $('#localidad_id').empty();
		    $('#localidad_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			$('#barrio_id').empty();
			$('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			$('#calle_id').empty();
			$('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

			//barrio
		    $.get('{{ url("/") }}/api/localidadescli?departamento_id=' + departamento_id,function(data) {
		      $.each(data, function(fetch, departamento){
		        console.log(data);
		        $('#localidad_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
		      })
		    });
		});


		$('#localidad_id').on('change', function(e){
		    console.log(e);
		    var localidad_id = e.target.value;

		    if (localidad_id !== '') {
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/validarsinbarrio',
					//url: '../api/validardocumento',
					data: {q: localidad_id}
				}).done(function(data) {
					//var $empleado = $('#empleado'); 
					if(data == 0) {
						$('#sinbarrio').val(0);
					} else{
						$('#sinbarrio').val(1);				
					}
					
				});
			} else {
				$('#sinbarrio').val(0);
			}
			//alert($('#sinbarrio').val());		
			$('#barrio_id').empty();
			$('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
			$('#calle_id').empty();
			$('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

			//barrio
		    $.get('{{ url("/") }}/api/barrios?localidad_id=' + localidad_id,function(data) {
		      $.each(data, function(fetch, barrio){
		        console.log(data);
		        $('#barrio_id').append('<option value="'+ barrio.id +'">'+ barrio.descripcion +'</option>');
		      })
		    });

			//calle
			$.get('{{ url("/") }}/api/calles?localidad_id=' + localidad_id,function(data) {
				$.each(data, function(fetch, calle){
				console.log(data);
				$('#calle_id').append('<option value="'+ calle.id +'">'+ calle.descripcion +'</option>');
				})
			});
		    /*id2 = $("#provincia_id option:selected").val();
		    cargar_departamentos(id2);*/
		});


		$('#barrio_id').on('change', function(e){
		    console.log(e);
		    var barrio_id = e.target.value;

		    if (barrio_id !== '') {
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/validarsincalle',
					//url: '../api/validardocumento',
					data: {q: barrio_id}
				}).done(function(data) {
					//var $empleado = $('#empleado'); 
					if(data == 0) {
						$('#sincalle').val(0);
					} else{
						$('#sincalle').val(1);				
					}
					
				});
			} else {
				$('#sincalle').val(0);
			}
			//alert($('#sincalle').val());		
			
		});

		// para habilitar listado para varias direcciones
		$('#direcciones').on('ifChecked', function (event){
		    $("#agregardireccion").show();
		    $("#table_direcciones").show();
		});
		$('#direcciones').on('ifUnchecked', function (event) {
		   $("#agregardireccion").hide();
		   $("#table_direcciones").hide();
		   $('#table_direccionesspan').hide();
		});



		/**/ 


		/*para agregar familiares al listado*/
		$( "#agregarfamiliares" ).click(function() {

			/*validaciones*/ 
			if($("#nombrefamiliar").val() == ''  || $("#contactofamiliar").val() == ''  || $("#tipofamiliar_id").val() == '')
			{
				toastr.error('No se puede agregar este familiar. Faltan datos');
				return false;
			} 
			/**/
			
			//variables para guardar en la grilla
			var tipofamiliar_id = $("#tipofamiliar_id").val();
			var tipofamiliar = $('select[name="tipofamiliar_id"] option:selected').text();
			var nombrefamiliar = $("#nombrefamiliar").val();
			var contactofamiliar = $("#contactofamiliar").val();
			
			//cargo la grilla
			$('#table_familiares tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + tipofamiliar_id + '</td>' +
				'<td>' + tipofamiliar + '</td>' +
				'<td>' + nombrefamiliar + '</td>' +
				'<td>' + contactofamiliar + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletefamiliar_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

			$("#vinculo_id").val('');
			$("#nombrevinculo").val('');
			$("#contactovinculo").val('');


			toastr.success('Familiar agregado a la lista');
			

		});

		$(document).ready(function(){
		    $("#contactovinculo").keypress(function(e) {
		        //no recuerdo la fuente pero lo recomiendan para
		        //mayor compatibilidad entre navegadores.
		        var code = (e.keyCode ? e.keyCode : e.which);
		        if(code==13){
		            $('#agregarfamiliares').click();  
		        }
		    });
		});


		/*borrar filas del listado de familiares*/
		function deletefamiliar_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Familiar eliminado de la lista');
		}


		function verificarlongitudnrocodumento() {
			var tipodocumento_id = $("#tipodocumento_id").val();

			var numerodocumento = $('#numerodocumento').val();

			numerodocumento = $.trim(numerodocumento);

			if(tipodocumento_id > 0  && numerodocumento.length < 1) {
				toastr.error('El campo numero de documento no puede estar vacio');
				return false;
			}

			if(tipodocumento_id > 0  && tipodocumento_id < 5) {
				if( numerodocumento.length !== 8) {
					toastr.error('Solo se permiten 8 digitos para este tipo de documento');
					return false;
				} 
			} 	else if(tipodocumento_id == 5) {
				if(numerodocumento.length > 12) {
					toastr.error('Solo se permiten 12 digitos para este tipo de documento');
					return false;
				} 
			}	else if(tipodocumento_id == 8) {
				if(numerodocumento.length > 15) {
					toastr.error('Solo se permiten 15 digitos para este tipo de documento');
					return false;
				} 
			}	else if(tipodocumento_id == 10) {
				if(numerodocumento.length !== 11) {
					toastr.error('Solo se permiten 11 digitos para este tipo de documento');
					return false;
				} 
			}	
		}



		$( "#guardar" ).click(function() {


			var estado = verificarlongitudnrocodumento();		

			if(estado == false) {
				$(":input").prop("disabled", true);
				$("#tipodocumento_id").prop("disabled", false);
				$("#numerodocumento").prop("disabled", false);
				return false;
			}					

		   // validaciones particulares
		   var estadocampos = 0;

		   // si es persona fisica
		   if($('#tipocliente_id').val() == 1){
		   		if($.trim($('#apellido').val()) == ''){
			   		estadocampos = 1;
			   		$('#apellidospan').show();
			   	} else{
			   		//estadocampos = 0;
			   		$('#apellidospan').hide();
			   	}

			   	if($.trim($('#nombre').val()) == ''){
			   		estadocampos = 1;
			   		$('#nombrespan').show();
			   	} else{
			   		//estadocampos = 0;
			   		$('#nombrespan').hide();
			   	}
		   } else {
		   		if($.trim($('#cliente').val()) == ''){
			   		estadocampos = 1;
			   		$('#clientespan').show();
			   	} else{
			   		//estadocampos = 0;
			   		$('#clientespan').hide();
			   	}

			   	if($.trim($('#referente').val()) == ''){
			   		estadocampos = 1;
			   		$('#referentespan').show();
			   	} else{
			   		//estadocampos = 0;
			   		$('#referentespan').hide();
			   	}
		   }

		   // listado de articulos
		    /*var listado = crear_listado_articulos();
      		$('#id_lista_articulos').val(listado);

      		if ($('#id_lista_articulos').val() == ''){
      			estadocampos = 1;
			   	$('#table_articulosspan').show();
      		} else {
      			$('#table_articulosspan').hide();
      		}*/

      		//vendedor
      		if($.trim($('#empleado_id').val()) == ''){
		   		estadocampos = 1;
		   		$('#empleado_idspan').show();
		   		$('#empleadospan').show();
		   	} else{
		   		//estadocampos = 0;
		   		$('#empleado_idspan').hide();
		   		$('#empleadospan').hide();
		   	}

		   	//direcciones aca
		   	//var checkdirecciones = $("#direcciones").parent('[class*="icheckbox"]').hasClass("checked");

		  
			if($('input[name=direcciones]:checkbox:checked').val() == '1')
			{	
			   	$('#provincia_idspan').hide();
				$('#departamento_idspan').hide();
				$('#localidad_idspan').hide();
				$('#barrio_idspan').hide();
				$('#calle_idspan').hide();
			   	$('#cargarobservacionpan').hide();

			   	var listado = crear_listado_direcciones();
	      		$('#id_lista_direcciones').val(listado);

	      		if ($('#id_lista_direcciones').val() == ''){
	      			estadocampos = 1;
				   	$('#table_direccionesspan').show();
	      		} else {
	      			$('#table_direccionesspan').hide();
	      		}
		   	} else {
		   		$('#table_direccionesspan').hide();
	      		var valdirecc = validardireccion();
			   	if(valdirecc == 1){
			   		estadocampos = 1;
			   	}
		   	}


		   
		   // si estadocampos == 1 faltaron algunos datos
		   if(estadocampos == 1) 
		   {
		   	swal({
					title: 'No se pueden guardar los datos',
					text: 'Existen campos vacios o mal cargados',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					//confirmButtonText: 'OK',
					//timer: 3500,
					closeOnConfirm: false
				});
				//toastr.error('No se pueden guardar los datos. Existen campos vacios o mal cargados');
		   		return false;
		   }

		   	// aca segunda validacion direcciones
		   	if(valdirecc == 2){
		   		return false;
		   	}

		   	// listado de familiares
		    var listado = crear_listado_familiares();
      		$('#id_lista_familiares').val(listado);
		   
      		if($('input[name=direcciones]:checkbox:checked').val() !== '1')
			{
				$.ajax({
					dataType: 'json',
					url: APP_URL + '/api/validardomicilioidentico',
					//url: '../api/validardocumento',
					data: {provincia: $('#provincia_id').val(), departamento: $('#departamento_id').val(), localidad: $('#localidad_id').val(), barrio: $('#barrio_id').val(), calle: $('#calle_id').val(), manzana: $('#manzana').val(), casa: $('#casa').val(), numero: $('#numero').val(), edificiotorre: $('#edificiotorre').val(), piso: $('#piso').val(), seccion: $('#seccion').val(), lote: $('#lote').val(), codigopostal: $('#codigopostal').val(), nrodocumento: $('#numerodocumento').val()}
				}).done(function(data) {

					if(data !== 0) {
						swal({ 
							title: "El domicilio registrado ya existe",
							text: "¿Desea Guardarlo?",
							type: "info",
							showCancelButton: true,
							//confirmButtonColor: "#DD6B55",
							confirmButtonText: "Guardar",
							cancelButtonText: "Ver registro identico", 
							closeOnConfirm: false,
							closeOnCancel: false },

							function(isConfirm){ 
							if (isConfirm) {
								$('#form').submit();
								//toastr.error('guardar');
							} else { 
								$('#cargarobservacion').val(1);
								$('#cargarobservacionspan').show();
								$("#observaciondomicilio").prop("disabled", false);
								url = APP_URL + "/clientes/"+ data;
								window.open(url, "_blank");
								swal.close()
							} 
						});
					} else{
						$('#form').submit();
						//toastr.error('no existe');
					}
					
				});
			} else {
				$('#form').submit();
			}

			//return false;


		});


	    function validardireccion(){

	    	var estadovalidacion = 0;
	    	//direccion
		   	if($('#provincia_id').val() == ''){
		   		$('#provincia_idspan').show();
		   		estadovalidacion = 1;
		   	} else{
		   		//estadocampos = 0;
		   		$('#provincia_idspan').hide();
		   	}
		   	if($('#departamento_id').val() == ''){
		   		$('#departamento_idspan').show();
		   		estadovalidacion = 1;
		   	} else{
		   		//estadocampos = 0;
		   		$('#departamento_idspan').hide();
		   	}
		   	if($('#localidad_id').val() == ''){
		   		$('#localidad_idspan').show();
		   		estadovalidacion = 1;
		   	} else{
		   		//estadocampos = 0;
		   		$('#localidad_idspan').hide();
		   	}
		   	

		   	sinbarrio = $('#sinbarrio').val();
		   	barrio_id = $('#barrio_id').val();

		   	if(sinbarrio == 0 && barrio_id == ''){
			   	$('#barrio_idspan').show();
			   	estadovalidacion = 1;
		   	}else{
		   		$('#barrio_idspan').hide();
		   	}


		   	sincalle = $('#sincalle').val();
		   	calle_id = $('#calle_id').val();

		   	if(sincalle == 0 && calle_id == ''){
			   	$('#calle_idspan').show();
			   	estadovalidacion = 1;
		   	}else{
		   		$('#calle_idspan').hide();
		   	}

		   	obs = $('#cargarobservacion').val();

		   	if(obs == 1 && $.trim($('#observaciondomicilio').val()) == ''){
			   	$('#cargarobservacionpan').show();
			   estadovalidacion = 1;
		   	}else{
		   		$('#cargarobservacionpan').hide();
		   	}
		   	
		   	//validar que este cargado al menos un campo de texto de domicilio
		   	if($.trim($('#numero').val()) == '' && $.trim($('#manzana').val()) == '' && $.trim($('#casa').val()) == '' && $.trim($('#edificiotorre').val()) == '' && $.trim($('#piso').val()) == '' && $.trim($('#seccion').val()) == '' && $.trim($('#lote').val()) == '' && $.trim($('#referenciadomicilio').val()) == ''){

		   		swal({
					title: 'No se pueden guardar los datos',
					text: 'Faltan datos en la direccion',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					//confirmButtonText: 'OK',
					//timer: 3500,
					closeOnConfirm: false
				});
				//toastr.error('No se pueden guardar los datos. Existen campos vacios o mal cargados');
		   		estadovalidacion = 2;
		   	}



			
	    }


		function crear_listado_direcciones() {
		    var listado = '';
		    //var provincia_id, departamento_id, localidad_id, barrio_id, calle_id, ;

		    $("#id_lista_articulos").val('');

		    $('#table_articulos tbody tr').each(function () {	 
		    provincia_id = $(this).find("td").eq(0).html();
		    departamento_id = $(this).find("td").eq(1).html();
		    localidad_id = $(this).find("td").eq(2).html();
		    barrio = $(this).find("td").eq(3).html();
		    calle = $(this).find("td").eq(4).html();
		    numero = $(this).find("td").eq(5).html();
		    manzana = $(this).find("td").eq(6).html();
		    casa = $(this).find("td").eq(7).html();
		    edificiotorre = $(this).find("td").eq(8).html();
		    piso = $(this).find("td").eq(9).html();
		    seccion = $(this).find("td").eq(10).html();
		    lote = $(this).find("td").eq(11).html();
		    codigopostal = $(this).find("td").eq(12).html();
		    referencia = $(this).find("td").eq(13).html();
		    observacion = $(this).find("td").eq(14).html();
		    empleado_id = $(this).find("td").eq(15).html();
		    horariovisita = $(this).find("td").eq(16).html();
		    horadesde = $(this).find("td").eq(17).html();
		    horahasta = $(this).find("td").eq(18).html();
		   	barrio_id = $(this).find("td").eq(19).html();
		    calle_id = $(this).find("td").eq(20).html();

		    listado += provincia_id + "|" + departamento_id + "|" + localidad_id + "|" + barrio_id + "|" + calle_id + "|" + numero + "|" + manzana + "|" + casa + "|" + edificiotorre + "|" + piso + "|" + seccion + "|" + lote + "|" + codigopostal + "|" + referencia + "|" + observacion + "|" + empleado_id + "|" + horariovisita + "|" + horadesde + "|" + horahasta + "&&&";
		    });

		      return listado;
	    }



	    function crear_listado_familiares() {
		    var listado = '';
		    var tipofamiliar_id, nombrefamiliar, contactofamiliar;

		    $("#id_lista_familiares").val('');

		    $('#table_familiares tbody tr').each(function () {	 
		    tipofamiliar_id = $(this).find("td").eq(0).html();
		    nombrefamiliar = $(this).find("td").eq(2).html();
		    contactofamiliar = $(this).find("td").eq(3).html();

		    listado += tipofamiliar_id + "|" + nombrefamiliar + "|" + contactofamiliar + "&&&";
		    });

		    return listado;
	    }

	</script>

@endpush