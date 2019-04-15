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
	{{ form::text('empleado', 'defalut', ['class' => 'form-control', 'id' => 'empleado', 'style'=> 'display: none']) }}
 	<div class="form-group">
		{{ form::label('tipoempleado_id', 'Tipo de Empleado *') }}
		{{ form::select('tipoempleado_id', isset($tipoempleados) ? $tipoempleados : [], null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
  	</div>
  	<div class="form-group">
		{{ form::label('sucursal_id', 'Sucursal *') }}
		{{ form::select('sucursal_id', isset($sucursales) ? $sucursales : [], null, ['class' => 'form-control', 'placeholder' => 'Seleccionar...'] ) }} 
  	</div>
	<div class="form-group">
		{{ form::label('apellido', 'Apellido *') }}
		{{ form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido']) }}
	</div>

	<div class="form-group">
		{{ form::label('nombre', 'Nombre *') }}
		{{ form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre']) }}
	</div>


</div>

