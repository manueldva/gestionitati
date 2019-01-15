@extends('adminlte::page')

@section('title', 'Gestión - Departamentos')

@section('content_header')
  <h1>
    Gestionar Departamentos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('departamentos.index')}}">Departamentos</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Departamento </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('departamentos.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<p> <strong>Codigo:</strong> {{ $departamento->id }}</p>

				<p> <strong>Provincia:</strong> {{ $departamento->provincia->descripcion }}</p>

				<p> <strong>Descripcion:</strong> {{ $departamento->descripcion }}</p>

				<p> <strong>Fecha Alta:</strong> {{ $departamento->fecha_alta }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
