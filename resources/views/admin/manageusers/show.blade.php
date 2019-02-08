@extends('adminlte::page')

@section('title', 'Gestión - Usuarios')

@section('content_header')
  <h1>
    Gestionar Usuarios
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('manageusers.index')}}">Usuarios</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Usuario </strong>
	</div>
		
	<div class="panel-body">
	    <div class="panel-body">
	        <div class="row">
	        	<div class="col-md-12">
					<div class="row col-md-12">
						<div class="form-group pull-right">
							<a href="{{ route('manageusers.index') }}" type="button" class="btn btn btn-default">
								<span class="fa fa-list">
								</span>
									Listado
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<p> <strong>Codigo:</strong> {{ $user->id }}</p>
					
					<p> <strong>Nombre:</strong> {{ $user->name }}</p>

					<p> <strong>Usuario:</strong> {{ $user->username }}</p>

					<p> <strong>Email:</strong> {{ $user->email }}</p>

					<p> <strong>Perfil:</strong> {{ $user->perfil->perfil }}</p>
					

					@if($user->file)
	                    <div class="form-group  {{ $image }}">
							<p> <strong>Imagen:</strong></p>
		                    <img src="{{ asset($user->file) }}" height="300" width="300">
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


