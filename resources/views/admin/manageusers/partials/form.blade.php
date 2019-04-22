<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('empleados.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">
	
	<div class="form-group">
		{{ form::label('name', 'Nombre *') }}
		{{ form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'readonly']) }}
	</div>

	<div class="form-group">
		{{ form::label('username', ' Usuario *') }}
		{{ form::text('username', null, ['class' => 'form-control', 'id' => 'username']) }}
		
	</div>

	<div class="form-group">
		{{ form::label('email', 'Email:') }}
		{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
	</div>

	<div class="form-group">
		{{ form::label('perfil_id', 'Perfil *') }}
		{{ form::select('perfil_id', $perfiles,  null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
	</div>


	<div id="resetpass" class="form-group " style="display:none">

			{{ form::label('resetpass', 'Resetear Contraseña:') }}
			<label>
				{{ Form::checkbox('resetpass','on')}} 
			</label>	
	</div>

	

</div>



@push('js')
	<script type="text/javascript">

		$("#perfil_id").select2();


	</script>
@endpush