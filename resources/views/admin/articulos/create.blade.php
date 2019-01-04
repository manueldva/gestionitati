@extends('adminlte::page')

@section('title', 'Gestión - Articulos')

@section('content_header')
    <h1>
      Gestionar Articulos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('articulos.index')}}">Articulos</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Articulo</strong>
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