<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('modelocontratos.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">

	<div class="form-group">
		{{ form::label('modelo', 'Nombre Modelo *') }}
		{{ form::text('modelo', null, ['class' => 'form-control', 'id' => 'modelo']) }}
	</div>

	<div class="form-group">
		{{ form::label('descripcion', 'Descripción *') }}
		{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) }}
	</div>

</div>


<div class="col-md-8">

	<br>
	<br>

	<div class="form-group">
		{{ form::label('cuerpo', 'Cuerpo del Contrato*') }}
		{{ form::textarea('cuerpo', null, ['class' => 'form-control', 'id' => 'cuerpo']) }}
	</div>



	

</div>



@push('js')
	
	<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

	<script type="text/javascript">

		CKEDITOR.replace('cuerpo');
	
		
	</script>
@endpush