<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('articulos.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">

	<div class="form-group">
		{{ form::label('codigo', 'Codigo *') }}
		{{ form::text('codigo', null, ['class' => 'form-control', 'id' => 'codigo']) }}
	</div>

	<div class="form-group">
		{{ form::label('descripcion', 'Descripcion *') }}
		{{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'codigo']) }}
	</div>

	<div class="form-group">
		{{ form::label('rubro_id', 'Rubro ') }}
		{{ form::select('rubro_id', $rubros,  null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
	</div>

	<div class="form-group">
		{{ form::label('proveedor_id', 'Proveedor ') }}
		{{ form::select('proveedor_id', $proveedores,  null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
	</div>

	<div class="form-group">
		{{ form::label('stock', 'Stock *') }}
		{{ form::number('stock', null , ['class' => 'form-control', 'id' => 'stock', 'min' => '0']) }}
	</div>

	<div class="form-group">
		{{ form::label('stockminimo', 'Stock Minimo *') }}
		{{ form::number('stockminimo', null , ['class' => 'form-control', 'id' => 'stockminimo' , 'min' => '0']) }}
	</div>

	<div class="form-group">
		{{ form::label('stockmaximo', 'Stock Maximo ') }}
		{{ form::number('stockmaximo', null , ['class' => 'form-control', 'id' => 'stockmaximo' , 'min' => '0']) }}
	</div>
	<div class="form-group">
		{{ form::label('preciounitario', 'Precio *') }}
		{{ form::number('preciounitario', null , ['class' => 'form-control', 'id' => 'preciounitario', 'min' => '0']) }}
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

	
		$("#rubro_id").select2();
		$("#proveedor_id").select2();


		

	</script>

@endpush

