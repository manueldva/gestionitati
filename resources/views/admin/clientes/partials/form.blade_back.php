
<div class="col-md-12"  style = "background-color: #EDF3F3;">
	<br>
	<div class="row col-md-12">
		<div class="form-group pull-right">
		     @if(!isset($guardar))
			  <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>
			  @endif

		      <a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default" style = "border: 1px gray solid;">
			  <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>
		</div>
	</div>
</div>



<div class="col-md-8">
	<br>
	<div class="form-group">
		<label>
			<!--<font color = "green" size="5">
				<span class="fa fa-phone"></span>
			</font>
			&nbsp;-->
			<font size="4">
				Datos Personales 
			</font>
		</label>
		<hr>
	</div>
	<div class="form-group">
		<div class="table-responsive">
			<table class="table table-striped table-hover" data-form="Form">
				<thead>
					<tr>
						<td> 
							{{ form::label('nombre', 'Cliente:') }}
							{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre', 'placeholder'=> 'Apellido y Nombre']) }}
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
							{{ form::label('fechanacimiento', 'Fecha de Nacimiento:') }}
							{{ form::date('fechanacimiento', null, ['class' => 'form-control', 'id' => 'fechanacimiento']) }}
						</td>
						<td> 
							{{ form::label('edad', 'Edad:') }}
							{{ form::text('edad', null, ['class' => 'form-control', 'id' => 'edad', 'readonly' => 'readonly']) }}
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
							{{ form::label('nrodocumento', 'Numero de Documento:') }}
							{{ form::number('nrodocumento', null, ['class' => 'form-control', 'id' => 'nrodocumento', 'placeholder'=> 'Ej: 15332445']) }}
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
							{{ form::label('sexo', 'Sexo:') }}
							&nbsp;&nbsp;
							<label>
								{{ Form::radio('sexo','masculino')}} Masculino
							</label>
							&nbsp;&nbsp;
							<label>
								{{ Form::radio('sexo','femenino')}} Femenino
							</label>
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
							{{ form::label('direccion', 'Dirección:') }}
							{{ form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion', 'placeholder'=> 'Calle - Numero - Manzana - Barrio']) }}
						</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<hr>
	<br>

	<div class="form-group">
		<label>
			&nbsp;&nbsp;
			<font color = "green" size="5">
				<span class="fa fa-phone"></span>
			</font>
			&nbsp;
			<font size="4">
				Contacto 
			</font>
		</label>
		<hr>
	</div>

	<div class="form-group">
		<div class="table-responsive">
			<table class="table table-striped table-hover" data-form="Form">
				<thead>
					<tr>
						<td> 
							{{ form::label('celular', 'Nro Celular:') }}
							{{ form::number('celular', null, ['class' => 'form-control', 'id' => 'celular']) }}
						</td>
						<td> 
							{{ form::label('empresacelular_id', 'Empresa:') }}
							{{ form::select('empresacelular_id', $empresacelulares, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
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
							{{ form::label('email', 'Correo Electronico:') }}
							{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
						</td>
					</tr>

				</thead>
			</table>
		</div>
	</div>
	
	<hr>

	<div class="form-group">
		<div class="table-responsive">
			<table class="table table-striped table-hover" data-form="Form">
				<thead>
					<tr>
						<td> 
							{{ form::label('nrosocio', 'Nro de Socio:') }}
							{{ form::text('nrosocio', null, ['class' => 'form-control', 'id' => 'nrosocio' ,'readonly' => 'readonly']) }}
						</td>
						<td> 
							{{ form::label('fechaingreso', 'Fecha de Ingreso:') }}
							{{ form::date('fechaingreso', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechaingreso']) }}
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
							{{ form::label('estadocliente_id', 'Estado:') }}
							{{ form::select('estadocliente_id', $estadoclientes, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
						</td>
						<td> 
							{{ form::label('motivo', 'Motivo:') }}
							{{ form::text('motivo', null, ['class' => 'form-control', 'id' => 'motivo']) }}
						</td>
					</tr>
					
				</thead>
			</table>
		</div>
	</div>
</div>
<!--
<div class="col-md-1">

</div>
-->
<div class="col-md-4">
	<br>
	<div>
		<center>
			<a type="label" class="form-control btn-success">
				@if(isset($cliente))
					{{ form::label('statuscliente', 'ESTADO: ' . $cliente->estadocliente->descripcion ) }}
				@else
					{{ form::label('statuscliente', 'ESTADO: SIN ESTADO') }}
				@endif
			</a>
		</center>
	</div>


	<br>
	<br>
	<div class="form-group">
		<label>
			<!--<font color = "green" size="5">
				<span class="fa fa-phone"></span>
			</font>
			&nbsp;-->
			<font size="4">
				Fotografia
			</font>
		</label>
		<hr>
	</div>
	<div class="form-group">
		<center>
			@if(isset($cliente->file))
				<img src="{{ asset($cliente->file) }}" height="300" width="300" id="viewimage">
			@else
				<img src="{{url('imagedefeult/userdefault.png')}}" height="300" width="300" id="viewimage">
			@endif
		</center>
	</div>


	<div class="form-group">
		{{ Form::file('image', ['id' => 'image']) }}
		<br>
	</div>
	<hr>	
	<br>

	<div class="form-group">
		
		<label>
			<font color = "error" size="5">
				<span class="fa fa-warning"></span>
			</font>
			&nbsp;&nbsp;
			<font size="4">
				Contacto de Emergencia 
			</font >
		</label>
		<hr>
	</div>

	<div class="form-group">
		{{ form::label('telefonoemergencia', 'Nro Telefono:') }}
		{{ form::number('telefonoemergencia', null, ['class' => 'form-control', 'id' => 'telefonoemergencia']) }}
	</div>

	<div class="form-group">
		{{ form::label('celularemergencia', 'Nro Celular:') }}
		{{ form::number('celularemergencia', null, ['class' => 'form-control', 'id' => 'celularemergencia']) }}
	</div>

	
</div>

<div class="col-md-12">
	<hr>
	<div >
		<center>
			<a type="label" class="form-control btn" style= "background: #81F7F3;">
				{{ form::label('statuscertificado', 'CERTIFICADO MEDICO: SIN DATOS') }}
			</a>
		</center>
	</div>
</div>




@push('js')
	<script type="text/javascript">

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
		function readURL(input) {

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
		});
		/* imagen */

	</script>
@endpush