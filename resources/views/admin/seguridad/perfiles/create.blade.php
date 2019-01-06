@extends('adminlte::page')

@section('title', 'MC_V2 - Perfiles')

@section('content_header')
    <h1>
      Gestionar Perfiles
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('perfiles.index')}}">Perfiles</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Perfil</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'perfiles.store']) !!}

				@include('admin.seguridad.perfiles.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection