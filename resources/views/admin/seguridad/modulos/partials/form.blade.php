<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('modulos.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		{{ form::label('descripcion', 'Descripcion *') }}
		{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) }}
	</div>
	<div class="form-group">
		{{ form::label('link', 'Link *') }}
		{{ form::text('link', null, ['class' => 'form-control', 'id' => 'link']) }}
	</div>
	<div class="form-group">
		{{ form::label('valor', 'Valor *') }}
		{{ form::text('valor', null, ['class' => 'form-control', 'id' => 'valor']) }}
	</div>

</div>


