@extends('adminlte::page')

@section('title', 'Gestión - Gastos')

@section('content_header')
  <h1>
    Gestionar Gastos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('gastos.index')}}">Gastos</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Gasto </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('gastos.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $gasto->id }}</p>

				<p> <strong>Fecha:</strong> {{ $gasto->fecha }}</p>

				<p> <strong>Tipo Comprobante:</strong> 
				
					@if($gasto->tipocomprobante_id)
						{{ $gasto->tipocomprobante->descripcion  }}
					@endif
				
				</p>

				<p> <strong>Tipo Gasto:</strong> 
					@if($gasto->rubrogasto_id)
						{{ $gasto->rubrogasto->descripcion  }}
					@endif
				</p>

				<p> <strong>Tipo Pago:</strong> 
				
					@if($gasto->tipopago_id == 1)
						Gasto
					@elseif($gasto->tipopago_id == 2)
						Compra
					@endif
				
				</p>

				<p> <strong>Medio Pago:</strong> 
				
					@if($gasto->tipopago_id == 1)
						Efectivo
					@elseif($gasto->tipopago_id == 2)
						Cheque
					@elseif($gasto->tipopago_id == 3)
						Transferencia
					@endif
				
				</p>

				<p> <strong>Proveedor:</strong> 
					@if($gasto->proveedorgasto_id)
						{{ $gasto->proveedorgasto->descripcion  }}
					@endif
				</p>


				<p> <strong>Detalle:</strong> {{ $gasto->detalle }}</p>

				<p> <strong>Monto:</strong> {{ $gasto->monto }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
