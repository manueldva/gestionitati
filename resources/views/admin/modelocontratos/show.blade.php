@extends('adminlte::page')

@section('title', 'Gestión - Modelo Contratos')
@section('content_header')
  <h1>
    Gestionar  Modelo Contratos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('modelocontratos.index')}}"> Modelo Contratos</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver  Modelo Contrato </strong>
	</div>
		
	<div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<div class="row col-md-12">
					<div class="form-group pull-right">
								<a href="{{ route('modelocontratos.index') }}" type="button" class="btn btn btn-default">
									<span class="fa fa-list">
									</span>
										Listado
								</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">

				<p> <strong>Codigo:</strong> {{ $modelocontrato->id }}</p>

				<p> <strong>Nombre Modelo:</strong> {{ $modelocontrato->modelo }}</p>

				<p> <strong>Descripcion:</strong> {{ $modelocontrato->descripcion }}</p>

				<p> <strong>Cuerpo:</strong> {!! $modelocontrato->cuerpo !!}</p>
			</div>
		</div>
	</div>
</div>

@endsection
