<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('proveedores.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">

	<div class="form-group">
		{{ form::label('nombre', 'Nombre *') }}
		{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre']) }}
	</div>

	<div class="form-group">
		{{ form::label('nombrecontacto', 'Nombre Contacto') }}
		{{ form::text('nombrecontacto', null, ['class' => 'form-control', 'id' => 'nombrecontacto']) }}
	</div>

	<div class="form-group">
		{{ form::label('domicilio', 'Domicilio') }}
		{{ form::text('domicilio', null , ['class' => 'form-control', 'id' => 'domicilio']) }}
	</div>

	<div class="form-group">
		{{ form::label('telefono', 'Nro Telefono') }}
		{{ form::number('telefono', null, ['class' => 'form-control', 'id' => 'telefono']) }}
	</div>
	<div class="form-group">
		{{ form::label('celular', 'Nro Celular') }}
		{{ form::number('celular', null, ['class' => 'form-control', 'id' => 'celular']) }}
	</div>
	<div class="form-group">
		{{ form::label('email', 'Correo Electronico') }}
		{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
	</div>

	<div class="form-group">
		{{ form::label('observaciones', 'Observaciones') }}
		{{ form::textarea('observaciones', null, ['class' => 'form-control']) }}
	</div>
	
	<br>

	<div class="form-group">
		{{ form::label('estado', 'Estado:') }}
		<label>
			{{ Form::radio('estado','Activo')}} Activo
		</label>
		<label>
			{{ Form::radio('estado','Inactivo')}} Inactivo
		</label>
	</div>


</div>




@push('js')		

	<script type="text/javascript">

	</script>

@endpush

