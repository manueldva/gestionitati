@extends('adminlte::page')

@section('title', 'Gestión - Calles')

@section('content_header')
  <h1>
    Gestionar Calles
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('calles.index')}}">Calles</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Calle </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('calles.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $calle->id }}</p>

				<p> <strong>Provincia:</strong> {{ $calle->provincia->descripcion }}</p>

				<p> <strong>departamento:</strong> {{ $calle->departamento->descripcion }}</p>

				<p> <strong>Localidad:</strong> {{ $calle->localidad->descripcion }}</p>

				<p> <strong>Calle:</strong> {{ $calle->descripcion }}</p>

				<p> <strong>Fecha Alta:</strong> {{ $calle->fecha_alta }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
