<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('barrios.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		{{ form::label('provincia', 'Provincia') }}
		{{ form::text('provincia', $barrio->provincia->descripcion, ['class' => 'form-control', 'id' => 'provincia', 'disabled']) }}
	</div>

	<div class="form-group">
		{{ form::label('departamento', 'Departamento') }}
		{{ form::text('departamento', $barrio->departamento->descripcion, ['class' => 'form-control', 'id' => 'departamento', 'disabled']) }}
	</div>

	<div class="form-group">
		{{ form::label('localidad', 'Localidad') }}
		{{ form::text('localidad', $barrio->departamento->descripcion, ['class' => 'form-control', 'id' => 'localidad', 'disabled']) }}
	</div>

	<div class="form-group">
      {{ form::label('distrito_id', 'Zona') }}
      {{ form::select('distrito_id', $distritos,  null, ['class' => 'form-control', 'id' => 'distrito_id','placeholder' => 'Seleccionar...'] ) }}
    </div>
	


	<div class="form-group">
		{{ form::label('descripcion', 'Descripción *') }}
		{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) }}
	</div>

	<div id="poseecalle" class="form-group ">

		{{ form::label('sincalle', 'No posee calles:') }}
		<label>
			{{ Form::checkbox('sincalle','1')}} 
		</label>	
	</div>

</div>





@push('js')
	<script type="text/javascript">

		
	</script>
@endpush