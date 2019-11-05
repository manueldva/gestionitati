<div class="col-md-12">
	<div class="row col-md-12">
		<div class="form-group pull-right">
		      <button type="submit" class="btn btn btn-primary">
		      	<span class="glyphicon glyphicon-floppy-disk">
		      	</span>
		      		Guardar
		      </button>

		      <a href="{{ route('gastos.index') }}" type="button" class="btn btn btn-default">
		      	<span class="fa fa-list">
		      	</span>
		      		Listado
		      </a>

		</div>
	</div>
</div>

<div class="col-md-6">
        <div class="form-group">
          {{ form::label('fecha', 'Fecha *') }}
		  {{ form::date('fecha', isset($gasto) ? $gasto->fecha : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
        </div>
        <div class="form-group">
          {{ form::label('tipocomprobante_id', 'Tipo Comprobante ') }}
          {{ form::select('tipocomprobante_id', $tipocomprobantes,  null, ['class' => 'form-control', 'id' => 'tipocomprobante_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('rubrogasto_id', 'Tipo Gasto') }}
          {{ form::select('rubrogasto_id', $rubrogastos,  null, ['class' => 'form-control', 'id' => 'rubrogasto_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('tipopago_id', 'Tipo de Pago ') }}
          {{ form::select('tipopago_id', $tipopagos,  null, ['class' => 'form-control', 'id' => 'tipopago_id'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('mediopago_id', 'Medio de Pago ') }}
          {{ form::select('mediopago_id', $mediopagos,  null, ['class' => 'form-control', 'id' => 'mediopago_id'] ) }}
        </div>
        <div class="form-group">
          {{ form::label('proveedorgasto_id', 'Proveedor ') }}
          {{ form::select('proveedorgasto_id', $proveedorgastos,  null, ['class' => 'form-control', 'id' => 'proveedorgasto_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('detalle', 'Detalle') }}
          {{ form::text('detalle', null, ['class' => 'form-control', 'id' => 'detalle']) }}
        </div>
        <div class="form-group">
          {{ form::label('monto', 'Monto') }}
          {{ form::number('monto', null, ['class' => 'form-control', 'id' => 'monto']) }}
        </div>
</div>





@push('js')
	<script type="text/javascript">

		
	</script>
@endpush