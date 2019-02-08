

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
					{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'placeholder'=> 'Razon Social']) }}
					<div id="razonsocialspan" class="form-group has-error"style="display: none">
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
										{{ form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido', 'placeholder'=> 'Apellido']) }}
										<div id="apellidospan" class="form-group has-error" style="display: none">
											<span class="help-block">Campo Obligatorio</span>
										</div>
										
									</td>
									<td> 
										{{ form::label('nombre', 'Nombre *') }}
										{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre', 'placeholder'=> 'Nombre']) }}
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
			      	{{ form::label('referente', 'Referente') }}
					{{ form::text('referente', null, ['class' => 'form-control', 'id' => 'referente', 'placeholder'=> 'Representante de la entidad']) }}
					<div id="referentespan" class="form-group has-error"  style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
			      </div>
				  <div class="form-group"  id = "tipoivas">
			      		{{ form::label('tipoiva_id', 'Concidicion IVA') }}
						{{ form::select('tipoiva_id', isset($tipoivas) ? $tipoivas : [], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
			      </div>
			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										<div id="fechanacimientos">
										{{ form::label('fechanacimiento', 'Fecha de Nacimiento') }}
										{{ form::date('fechanacimiento', null, ['class' => 'form-control', 'id' => 'fechanacimiento']) }}
										</div>
									</td>
									<td> 
										<div id="edades">
										{{ form::label('edad', 'Edad') }}
										{{ form::text('edad', null, ['class' => 'form-control', 'id' => 'edad', 'readonly' => 'readonly']) }}
										</div>
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
								</tr>	
								<!--
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
								-->
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
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
					
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>	
									<td class="col-md-3"> 
										{{ form::label('articulo_id', 'Cod.') }}
										{{ form::number('articulo_id', null, ['class' => 'form-control', 'id' => 'articulo_id']) }}
									</td>
									<td>
										{{ form::label('articulo', 'Articulo') }}
										<br>
										{{ form::select('articulo', $articulos,  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
									</td>
								</tr>

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
						{{ form::label('departamento_id', 'Departamento') }}
						{{ form::select('departamento_id', isset($cliente) ? $departamentos : [],  null, ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('localidad_id', 'Localidad') }}
						{{ form::select('localidad_id', isset($cliente) ? $localidades : [],  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}

						{{ form::text('sinbarrio', 0, ['class' => 'form-control', 'id' => 'sinbarrio']) }}
					</div>
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio') }}
						{{ form::select('barrio_id', isset($cliente) ? $barrios : [],  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
						{{ form::text('sincalle', 0, ['class' => 'form-control', 'id' => 'sincalle']) }}
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
										{{ form::label('empleado_id', 'Cod.') }}
										{{ form::number('empleado_id', null, ['class' => 'form-control', 'id' => 'empleado_id']) }}
									</td>
									<td> 
										{{ form::label('empleado', 'Vendedor') }}
										<br>
										{{ form::select('empleado',$empleados,  null, ['class' => 'form-control inline-search', 'id' => 'empleado','placeholder' => 'Seleccionar...'] ) }}
										
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
									{{ form::select('vinculo_id', $tipofamiliar,  null, ['class' => 'form-control', 'id' => 'vinculo_id','placeholder' => 'Seleccionar...'] ) }}
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
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		//$('#numerodocumento').addClass('has-error');

		
		var APP_RL = "{{ url('/') }}";

		$("#sincalle").hide();		
		$("#sinbarrio").hide();

		/*de movida todo tiente que estar bloqueado*/
		
		$(":input").prop("disabled", true);
		$("#tipodocumento_id").prop("disabled", false);
		$("#numerodocumento").prop("disabled", false);

		
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
			CalcularEdad();
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
						if(parseInt($('#id').val()) !== parseInt(data)){
							swal({
							title: "El cliente ingresado ya existe",
							text: "Verefique los datos",
							type: "info",
							//showCancelButton: true,
							closeOnConfirm: true//,
							//showLoaderOnConfirm: true
							}, function () {
							window.location.replace("../clientes/"+ data +"/edit");

							});
						}
					} else{
						toastr.success('Numero de documento no existente en la base de datos');
						$(":input").prop("disabled", false);
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

		/**/

		/*buscador vendedor*/
			/*
		    $('#empleado').select2({
				language: {

					noResults: function() {

					return "No hay resultado";        
					},
					searching: function() {

					return "Buscando..";
					},
				},
				
		        ajax : {
		            url : APP_URL + '/api/autocompleteempleadodesc',
		            //url : '../api/autocompleteempleadodesc',
		            dataType : 'json',
		            delay : 20,
		            data : function(params){
		                return {
		                    q : params.term,
		                    page : params.page
		                };
		            },
		            processResults : function(data, params){
		                params.page = params.page || 1;
		                return {
		                    results : data.data,
		                    pagination: {
		                        more : (params.page  * 10) < data.total
		                    }
		                };
		            }
		        },
				minimumInputLength: 1,
		        templateResult : function (repo){
		            if(repo.loading) return repo.empleado;
		            var markup =  repo.empleado;
		            return markup;
		        },
		        templateSelection : function(repo)
		        {
					$("#empleado_id").val(repo.id);
					$("#patente").val(repo.patente);
					$("#movil").val(repo.movil);
					
					return repo.empleado;
					
		        },
		        escapeMarkup : function(markup){ 
					
					return markup; 
				}
		    });
			*/

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

		

		//buscador articulos
		function buscarArticulos(articulo_id) {

			//alert(articulo_id);

			if (articulo_id !== '') {
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/articulos',
				//url: '../api/validardocumento',
				data: {q: articulo_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data !== 0) {
					$("#articulo_id").val(data.id);
					$("#articulo").val(data.id);
					$("#cantidadarticulo").val(1);

					//$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
					//toastr.info('Codigo de vendedor correcto');
				} else{
					$("#articulo_id").val('');
					$("#articulo").val('');
					$("#cantidadarticulo").val('');
					
				}
				
			});
			} else {
				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');
			}
		}


		$('#articulo_id').focusout(function(e) {

			buscarArticulos($('#articulo_id').val());

		});

		$(document).ready(function(){
			$("#articulo_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
			var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					buscarArticulos($('#articulo_id').val());

				}
			});
		});

		$('#articulo').on('change', function(e){
			buscarArticulos($('#articulo').val());
		});


		/*para agregar articulos al listado*/
		$( "#agregararticulo" ).click(function() {

			//para validar que no supere el stock ya ingresado en la grilla*/
			/*var stocktemp = 0;
			$('#table_ventas tr').each(function(index, element) {
			    codigotemp = $(element).find("td").eq(0).text();
			    cantidadtemp = $(element).find("td").eq(2).text();

			    if(codigotemp == $("#articulo_id").val())
			    {
			    	stocktemp = stocktemp + parseInt(cantidadtemp);
			    }
			

			});

			stocktemp = parseInt($("#stockarticulo").val()) - stocktemp;
			//
			
			//validaciones 
			if($("#stockarticulo").val() == ''  || $("#cantidadarticulo").val() == '') {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});
				return false;
			} else if(parseInt($("#cantidadarticulo").val()) < 1) {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'Debe ingresar una cantidad mayor o igual a 1',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});

				return false;

			} else if(stocktemp < parseInt($("#cantidadarticulo").val())) {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'El stock actual es menor a la cantidad ingresada',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});

				return false;
			}

			*/
			if($('#articulo_id').val() == ''  || $("#cantidadarticulo").val() == '') {
				/*swal({
					title: 'No se puede agregar este articulo',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});*/

				toastr.error('No se puede agregar este articulo. Faltan datos');
				return false;
			}

			//variables para guardar en la grilla
			var codigo = $('#articulo_id').val();
			//var descripcion = $("#descripcionarticulo").val();
			var descripcion =$('select[name="articulo"] option:selected').text();
			var cantidad = parseInt($('#cantidadarticulo').val());

			//cargo la grilla
			$('#table_articulos tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');

			toastr.success('Articulo agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}



		/*para combos de domicilio*/
		$('#provincia_id').on('change', function(e){
		    console.log(e);
		    var provincia_id = e.target.value;

		    $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

		      $('#departamento_id').empty();
		      $('#departamento_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			  $('#localidad_id').empty();
		      $('#localidad_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			  $('#barrio_id').empty();
		      $('#barrio_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			  $('#calle_id').empty();
			  $('#calle_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');

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
		    $('#localidad_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			$('#barrio_id').empty();
			$('#barrio_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			$('#calle_id').empty();
			$('#calle_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');

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
			$('#barrio_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');
			$('#calle_id').empty();
			$('#calle_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');

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


		/**/ 


		/*para agregar familiares al listado*/
		$( "#agregarfamiliares" ).click(function() {

			/*validaciones*/ 
			if($("#nombrevinculo").val() == ''  || $("#contactovinculo").val() == ''  || $("#vinculo_id").val() == '') {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});
				return false;
			} 
			/**/
			
			//variables para guardar en la grilla
			var vinculo_id = $("#vinculo_id").val();
			var vinculo = $('select[name="vinculo_id"] option:selected').text();
			var nombrevinculo = $("#nombrevinculo").val();
			var contactovinculo = $("#contactovinculo").val();
			
			//cargo la grilla
			$('#table_familiares tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + vinculo_id + '</td>' +
				'<td>' + vinculo + '</td>' +
				'<td>' + nombrevinculo + '</td>' +
				'<td>' + contactovinculo + '</td>' +
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
				/*swal({
						title: "El campo numero de documento no puede estar vacio",
						text: "Verefique los datos",
						type: "warning",
						//showCancelButton: true,
						closeOnConfirm: true//,
						//showLoaderOnConfirm: true
						}, function () {
							return false;
						});*/
				toastr.error('El campo numero de documento no puede estar vacio');
				return false;
			}

			if(tipodocumento_id > 0  && tipodocumento_id < 5) {
				if( numerodocumento.length > 8) {
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
				if(numerodocumento.length > 11) {
					toastr.error('Solo se permiten 11 digitos para este tipo de documento');
					return false;
				} 
			}	
		}



		$( "#guardar" ).click(function() {
			var estado = verificarlongitudnrocodumento();
			
			if(estado == false) return false;					
		   //$('#form').submit();
		});

	</script>

@endpush