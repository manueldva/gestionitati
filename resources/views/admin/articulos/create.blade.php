@extends('adminlte::page')

@section('title', 'Gestión - Productos')

@section('content_header')
    <h1>
      Gestionar Productos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('articulos.index')}}">Productos</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Producto</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'articulos.store']) !!}

				@include('admin.articulos.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection