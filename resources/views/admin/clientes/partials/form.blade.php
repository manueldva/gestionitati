

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
			      	{{ form::label('id', 'Codigo *') }}
					{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly'=> 'readonly']) }}
			      </div>
			      <div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('tipodocumento_id', 'Tipo de Documento') }}
										{{ form::select('tipodocumento_id', [1 => 'DNI'], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
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
					{{ form::select('tipocliente_id', [1 => 'Persona Fisica'], null, ['class' => 'form-control'] ) }} 
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
										{{ form::select('tipoiva_id', [1 => 'MONOTRIBURO'], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
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
						{{ form::label('articulo_id', 'Buscar Articulo *') }}
						{{ form::select('articulo_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'articulo_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<td> 
										{{ form::label('cantidad', 'Cantidad') }}
										{{ form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']) }}
									</td>
									<td> 
										<br>
										<a href="" type="button" id="agregarvinculo" name="agregarvinculo" class="btn btn btn-success">
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
											<th> Articulo</th>
											<th> Cantidad</th>
											<th> </th>
										</tr>
									</thead>
									<tbody>
										<!--prueba-->
										<tr>
											<td>
												Articulo 1
											</td>
											<td>
												1
											</td>
											<td>
												Editar
											</td>
										</tr>
										<tr>
											<td>
												Articulo 2
											</td>
											<td>
												2
											</td>
											<td>
												Editar
											</td>
										</tr>
										<!--	-->
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
						{{ form::select('provincia_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('departamento_id', 'Departamento') }}
						{{ form::select('departamento_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('localidad_id', 'Localidad') }}
						{{ form::select('localidad_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('barrio_id', 'Barrio') }}
						{{ form::select('barrio_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'barrio_id','placeholder' => 'Seleccionar...'] ) }}
					</div>
					<div class="form-group">
						{{ form::label('calle_id', 'Calle ') }}
						{{ form::select('calle_id', [],  null, ['class' => 'form-control inline-search', 'id' => 'calle_id','placeholder' => 'Seleccionar...'] ) }}
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
										{{ form::select('companiatelefonica_id', [1 => 'Personal'], null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
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
										{{ form::label('codigovendedor', 'Codigo') }}
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
											{{ form::label('turno', 'visita') }}
											{{ form::select('turno', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  null, ['class' => 'form-control', 'id' => 'turno','placeholder' => 'Seleccionar...'] ) }}
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
									{{ form::text('contactovinculo', null, ['class' => 'form-control', 'id' => 'contactovinculo']) }}
								</td>
								<td> 
									<br>
									<a href="" type="button" id="agregarvinculo" name="agregarvinculo" class="btn btn btn-success">
					                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
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
									<th> Vinculo</th>
									<th> Apellido y Nombre</th>
									<th>Contacto </th>
								</tr>
							</thead>
							<tbody>
								<!--prueba-->
								<tr>
									<td>
										Esposa
									</td>
									<td>
										Elsa Gutierrez
									</td>
									<td>
										3704003322
									</td>
									<td>
										Editar
									</td>
								</tr>
								<!--	-->
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

	<script type="text/javascript">
		var APP_URL = "{{ url('/') }}";
		/*swal({
		  title: "An input!",
		  text: "Write something interesting:",
		  type: "input",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  //animation: "slide-from-top",
		  inputPlaceholder: "Write something"
		},
		function(inputValue){
		  if (inputValue === false) return false;

		  if (inputValue === "") {
		    swal.showInputError("You need to write something!");
		    return false
		  }

		  swal("Nice!", "You wrote: " + inputValue, "success");
		});*/
		
		/*function sweetDelete(id){
			swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: "input",
			  //type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Guardar',
			  cancelButtonText: 'Cancelar',
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false
			}).then(function () {
			  // código que elimina
			  $.ajax({
			    url:'../Controllers/libros.php',
			    type:'POST',
			    data:'idusuario='+id+'&boton=eliminar'
			   }).done(function(resp){
			    lista_libros('');
			   });
			  swal(
			    'Deleted!',
			    'Your file has been deleted.',
			    'success'
			  )
			}, function (dismiss) {
			  // dismiss can be 'cancel', 'overlay',
			  // 'close', and 'timer'
			  if (dismiss === 'cancel') {
			    swal(
			      'Cancelled',
			      'Your imaginary file is safe :)',
			      'error'
			    )
			  }
			})
		};


		sweetDelete(1);*/	
	  

		$('#articulo_id').select2();
		$('#provincia_id').select2();
		$('#departamento_id').select2();
		$('#localidad_id').select2();
		$('#barrio_id').select2();
 		$('#calle_id').select2();
		/*para calcular edad a partir de una fecha de nacimientpo*/
		function CalcularEdad() {
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

		CalcularEdad();

		$('#fechanacimiento').focusout(function(e) {
			CalcularEdad();
		});

		
		$('#numerodocumento').focusout(function(e) {

			/*recuper si existe cliente*/
			
			var nrodoc = $('#numerodocumento').val();
			
			$.ajax({
		    	dataType: 'json',
		    	url: APP_URL + '/api/validardocumento',
		    	data: {q: nrodoc}
			}).done(function(data) {

				if(data !== 0) {
					if(parseInt($('#id').val()) !== parseInt(data)){
						swal({
						  title: "Ya existe un cliente con este numero de documento",
						  text: "¿Desea recuperar sus datos?",
						  type: "info",
						  showCancelButton: true,
						  closeOnConfirm: false//,
						  //showLoaderOnConfirm: true
						}, function () {
						  window.location.replace("../clientes/"+ data +"/edit");

						});
					}
				}
				
			});

		});

		/*buscador vendedor*/

		$(document).ready(function(){
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
					/*$("#stock").val(repo.stock);
					$("#descripcion").val(repo.descripcion);
					$("#precio").val(repo.preciounitario);
					if($("#stock").val() !== '') $("#cantidad").val(1);*/
					
					return repo.empleado;
					
                },
                escapeMarkup : function(markup){ 
					
					return markup; 
				}
            });
        });

	</script>
@endpush