

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
					{{ form::label('tipocliente_id', 'Tipo de Cliente *') }}
					{{ form::select('tipocliente_id', [1 => 'Persona Fisica'], null, ['class' => 'form-control'] ) }} 
				  </div>
			      <div class="form-group">
			      	{{ form::label('cliente', 'Cliente *') }}
					{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'placeholder'=> 'Apellido y Nombre / Razon Social']) }}
			      </div>
			      <div class="form-group">
			      	{{ form::label('referente', 'Referente') }}
					{{ form::text('cliente', null, ['class' => 'form-control', 'id' => 'cliente', 'placeholder'=> 'Representante de la entidad', 'readonly' => 'readonly']) }}
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
										<a href="" type="button" class="btn btn btn-success">
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
				  </div>

			    </div>
			    <!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			<!--</div>-->
			<!-- /.col -->
	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
</div>




@push('js')
	<script type="text/javascript">

		 $('#articulo_id').select2();

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
		
		/*function Edad() {
			fecha = $('#fechanacimiento').val();
			var edad = CalcularEdad(fecha);
			$('#edad').val(edad);
		}*/

		CalcularEdad();

		$('#fechanacimiento').focusout(function(e) {
			CalcularEdad();
		});

		/* edad */

		/* para actualizar en tiempo real la imagen seleccionada*/
		/*function readURL(input) {

			if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#viewimage').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
			}
		}

		$("#image").change(function() {
			readURL(this);
		});*/
		/* imagen */

	</script>
@endpush