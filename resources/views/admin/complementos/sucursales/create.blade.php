@extends('adminlte::page')

@section('title', 'Gestión - Sucursales')

@section('content_header')
    <h1>
      Gestionar Sucursales
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('sucursales.index')}}">Sucursales</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Sucursal</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'sucursales.store']) !!}

				@include('admin.complementos.sucursales.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection