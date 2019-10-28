@extends('adminlte::page')

@section('title', 'Gestión - Tipo Comprobantes')

@section('content_header')
  <h1>
    Gestionar Tipo Comprobantes
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('tipocomprobantes.index')}}">Tipo Comprobantes</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Tipo Comprobante </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('tipocomprobantes.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $tipocomprobante->id }}</p>

				<p> <strong>Tipo Comprobante:</strong> {{ $tipocomprobante->descripcion }}</p>

				<p> <strong>Fecha Comprobante:</strong> {{ $tipocomprobante->fecha_alta }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
