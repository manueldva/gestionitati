

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
										{{ form::text('numerodocumento', null, ['class' => 'form-control', 'id' => 'numerodocumento']) }}
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
			      </div>
			      <div class="form-group" id="apellidoynombre">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('apellido', 'Apellido *') }}
										{{ form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido', 'placeholder'=> 'Apellido']) }}
									</td>
									<td> 
										{{ form::label('nombre', 'Nombre *') }}
										{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre', 'placeholder'=> 'Nombre']) }}
									</td>
								</tr>
							</thead>
						</table>
					</div>
				  </div>

			      <div class="form-group" id="referentes">
			      	{{ form::label('referente', 'Referente') }}
					{{ form::text('referente', null, ['class' => 'form-control', 'id' => 'referente', 'placeholder'=> 'Representante de la entidad']) }}
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
										<div id = "tipoivas">
										{{ form::label('tipoiva_id', 'Concidicion IVA') }}
										{{ form::select('tipoiva_id', isset($tipoivas) ? $tipoivas : [], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
										</div>
									</td>
									<td> 
										<div id = "cuits">
										{{ form::label('cuit', 'Cuit *') }}
										{{ form::text('cuit', null, ['class' => 'form-control', 'id' => 'cuit']) }}
										</div>
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

	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">
		var APP_URL = "{{ url('/') }}";

		//$('#articulo_id').select2();
		$('#provincia_id').select2();
		$('#localidad_id').select2();
		$('#barrio_id').select2();
			$('#calle_id').select2();
		/*para calcular edad a partir de una fecha de nacimientpo*/
		function calcularEdad() {
			FechaNacimiento = $('#fechanacimiento').val();
			var fechaNace = new Date(FechaNacimiento);
			var fechaActual = new Date()
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
			if ($("#tipocliente_id").val() == '1'){
				$("#razonsocial").hide();
				$("#apellidoynombre").show();
				$("#referentes").hide();
				$("#tipoivas").hide();
				$("#cuits").hide();
			} else {
				$("#razonsocial").show();
				$("#apellidoynombre").hide();
				$("#referentes").show();
				$("#tipoivas").show();
				$("#cuits").show();
			}

		}

		habilitarCliente();

		$('#tipocliente_id').change(function(e) {
			habilitarCliente();
		});

		/*recuper si existe cliente*/

		function verificarDocumento() {

			var nrodoc = $('#numerodocumento').val();
			var tipodoc = $('#tipodocumento_id').val();
			
			$.ajax({
		    	dataType: 'json',
		    	url: APP_URL + '/api/validardocumento',
		    	//url: '../api/validardocumento',
		    	data: {q: nrodoc, t:tipodoc}
			}).done(function(data) {

				if(data !== 0) {
					if(parseInt($('#id').val()) !== parseInt(data)){
						swal({
						  title: "Ya existe un cliente con este numero de documento",
						  text: "¿Desea recuperar sus datos?",
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
				}
				
			});
		}


		$('#numerodocumento').focusout(function(e) {
			 verificarDocumento();

		});

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

		/*buscador vendedor*/

		//$(document).ready(function(){
		    $('#empleado').select2({
			    /*allowClear: true,
			    multiple: true,
			    maximumSelectionSize: 1,*/
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
					$("#codigovendedor").val(repo.id);
					
					return repo.empleado;
					
		        },
		        escapeMarkup : function(markup){ 
					
					return markup; 
				}
		    });
		//});

		//buscador articulos
		function buscarArticulos() {
			$('#articulo').select2({
			    /*allowClear: true,
			    multiple: true,
			    maximumSelectionSize: 1,*/
				language: {

					noResults: function() {

					return "No hay resultado";        
					},
					searching: function() {

					return "Buscando..";
					},
				},
				
		        ajax : {
		            url : APP_URL + '/api/articulos',
		            //url : '../api/articulos',
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
		            if(repo.loading) return repo.descripcion;
		            var markup =  repo.descripcion;
		            return markup;
		        },
		        templateSelection : function(repo)
		        {
					$("#articulo_id").val(repo.id);
					$("#stockarticulo").val(repo.stock);
					$("#descripcionarticulo").val(repo.descripcion);
					if($("#stockarticulo").val() !== '') $("#cantidadarticulo").val(1);
					
					return repo.descripcion;
					
		        },
		        escapeMarkup : function(markup){ 
					
					return markup; 
				}
		    });
		}

		buscarArticulos();


		/*para agregar articulos al listado*/
		$( "#agregararticulo" ).click(function() {

			/*para validar que no supere el stock ya ingresado en la grilla*/
			var stocktemp = 0;
			$('#table_ventas tr').each(function(index, element) {
			    codigotemp = $(element).find("td").eq(0).text();
			    cantidadtemp = $(element).find("td").eq(2).text();

			    if(codigotemp == $("#articulo_id").val())
			    {
			    	stocktemp = stocktemp + parseInt(cantidadtemp);
			    }
			   
			    //alert(codigotemp);

			});

			stocktemp = parseInt($("#stockarticulo").val()) - stocktemp;
			/**/
			
			/*validaciones*/ 
			if($("#stockarticulo").val() == ''  || $("#cantidadarticulo").val() == '') {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});
				return false;
			} else if(parseInt($("#cantidadarticulo").val()) < 1) {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'Debe ingresar una cantidad mayor o igual a 1',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});

				return false;

			} else if(stocktemp < parseInt($("#cantidadarticulo").val())) {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'El stock actual es menor a la cantidad ingresada',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
					closeOnConfirm: false
				});

				return false;
			}

			/**/
			
			//variables para guardar en la grilla
			var codigo = $("#articulo_id").val();
			var descripcion = $("#descripcionarticulo").val();
			var cantidad = parseInt($("#cantidadarticulo").val());
			
			//cargo la grilla
			$('#table_articulos tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

			$("#cantidadarticulo").val(1);

			toastr.success('Articulo agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}



		/*para agregar familiares al listado*/
		$( "#agregarfamiliares" ).click(function() {

			/*validaciones*/ 
			if($("#nombrevinculo").val() == ''  || $("#contactovinculo").val() == ''  || $("#vinculo_id").val() == '') {
				swal({
					title: 'No se puede agregar este articulo',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK!',
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


		/*borrar filas del listado de familiares*/
		function deletefamiliar_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Familiar eliminado de la lista');
		}




		$( "#guardar" ).click(function() {
		   //$('#form').submit();
		});

	</script>

@endpush