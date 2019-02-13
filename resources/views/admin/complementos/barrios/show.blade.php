@extends('adminlte::page')

@section('title', 'Gestión - Barrios')

@section('content_header')
  <h1>
    Gestionar Barrios
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('barrios.index')}}">Barrios</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Barrio </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('barrios.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $barrio->id }}</p>

				<p> <strong>Provincia:</strong> {{ $barrio->provincia->descripcion }}</p>

				<p> <strong>departamento:</strong> {{ $barrio->departamento->descripcion }}</p>

				<p> <strong>Localidad:</strong> {{ $barrio->localidad->descripcion }}</p>
				@if($barrio->distrito_id)
					<p> <strong>Zona:</strong> {{ $barrio->distrito->descripcion }}</p>
				@endif

				<p> <strong>Barrio:</strong> {{ $barrio->descripcion }}</p>


				<p> <strong>Posee Calle:</strong> 
					@if($barrio->sincalle == 0)
						SI
					@else
						NO
					@endif
				</p>


				<p> <strong>Fecha Alta:</strong> {{ $barrio->fecha_alta }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
