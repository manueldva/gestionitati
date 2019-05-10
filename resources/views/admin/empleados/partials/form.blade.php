
<div class="row">
	<div class="col-md-12">	
	  <div class="box box-default">
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Datos Personales</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
		      		
		      		<div class="form-group">
					  	{{ form::label('id', 'Codigo Empleado') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly'=> 'readonly']) }}
				  	</div>

				  	{{ form::text('empleado', 'defalut', ['class' => 'form-control', 'id' => 'empleado', 'style'=> 'display: none']) }}
				  	<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped table-hover" data-form="Form">
								<thead>
									<tr>
										<td> 
											{{ form::label('apellido', 'Apellido *') }}
											{{ form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido']) }}
										</td>
										<td> 
											{{ form::label('nombre', 'Nombre *') }}
											{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre']) }}
										</td>
									</tr>		
									<tr>
										<td> 
											{{ form::label('tipodocumento_id', 'Tipo Documento') }}
											{{ form::select('tipodocumento_id', isset($tipodocumentos) ? $tipodocumentos : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
										</td>
										<td> 
											{{ form::label('numerodocumento', 'Nro Documento ') }}
											{{ form::text('numerodocumento', null, ['class' => 'form-control', 'id' => 'numerodocumento']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('fechanacimiento', 'Fecha Nacimiento') }}
											{{ form::date('fechanacimiento', null, ['class' => 'form-control', 'id' => 'fechanacimiento']) }}
										</td>
										<td> 
											{{ form::label('edad', 'Edad ') }}
											{{ form::text('edad', null, ['class' => 'form-control', 'id' => 'edad', 'readonly'=> 'readonly']) }}
										</td>
									</tr>	
									<tr>
										<td> 
											{{ form::label('estadocivil', 'Estado Civil') }}
											{{ form::select('estadocivil', isset($tipodocumentos) ? $tipodocumentos : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
										</td>
										<td> 
											{{ form::label('sexo', 'Sexo') }}
											{{ form::select('sexo', ['m'=>'Masculino', 'f'=> 'Femenino', 'o'=>'Otros'], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
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
			      <i class="fa fa-mobile-phone"></i>

			      <h3 class="box-title">Contacto</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="form-group">
					{{ form::label('telefonoparticular', 'Telefono Particular') }}
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
										{{ form::select('companiatelefonica_id', isset($companiatelefonicas) ? $companiatelefonicas : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
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
			    <hr>
			    <div class="box-header with-border">
			      <i class="fa fa-home"></i>

			      <h3 class="box-title">Dirección</h3>
			    </div>

			    <div class="box-body">
			      <div class="form-group">
					{{ form::label('localidad_id', 'Localidad') }}
					{{ form::select('localidad_id', isset($localidades) ? $localidades : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
				  </div>
			      <div class="form-group">
			      	{{ form::label('direccion', 'Dirección') }}
					{{ form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion']) }}
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
			      <!--<i class="fa fa-user"></i>-->

			      <h3 class="box-title">Rol de Empleado:</h3>
			    </div>
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-6">
			  <!--<div class="box box-default">-->
			    
			    <!-- /.box-header -->
			    <div class="box-body">
		      		
		      		<div class="form-group">
						{{ form::label('tipoempleado_id', 'Tipo de Empleado *') }}
						{{ form::select('tipoempleado_id', isset($tipoempleados) ? $tipoempleados : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
				  	</div>

					
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-body">
			    <!-- /.box-header -->
				    <div class="form-group">
						{{ form::label('sucursal_id', 'Sucursal *') }}
						{{ form::select('sucursal_id', isset($sucursales) ? $sucursales : [], null, ['class' => 'form-control', 'placeholder' => 'Seleccionar...'] ) }} 
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


</div>
	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		
		$("#guardar").click(function() {

			
      		$('#form').submit();

		
		});



		function Edad(FechaNacimiento) {

		    var fechaNace = new Date(FechaNacimiento);
		    var fechaActual = new Date()
		    var mes = fechaActual.getMonth();
		    var dia = fechaActual.getDate();
		    var año = fechaActual.getFullYear();

		    fechaActual.setDate(dia);

		    fechaActual.setMonth(mes);

		    fechaActual.setFullYear(año);
		    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

		    return edad;

		}


		$('#fechanacimiento').on('change', function(e){

			var fecha = document.getElementById('fechanacimiento').value;
			var edad = Edad(fecha);

			if(edad == 'NaN'){
				$('#edad').val('');
			} else {
				$('#edad').val(edad);
			}
			
		});



	</script>

@endpush



