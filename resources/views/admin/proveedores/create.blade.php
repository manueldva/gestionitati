@extends('adminlte::page')

@section('title', 'Gestión - Proveedores')

@section('content_header')
    <h1>
      Gestionar Proveedores
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('proveedores.index')}}">Proveedores</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Proveedor</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'proveedores.store']) !!}

				@include('admin.proveedores.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection