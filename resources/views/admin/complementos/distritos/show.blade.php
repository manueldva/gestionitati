@extends('adminlte::page')

@section('title', 'Gestión - Distritos')

@section('content_header')
  <h1>
    Gestionar Distritos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('distritos.index')}}">Distritos</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Distrito </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('distritos.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $distrito->id }}</p>

				<p> <strong>Distrito:</strong> {{ $distrito->descripcion }}</p>

				<p> <strong>Fecha Alta:</strong> {{ $distrito->fecha_alta }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
