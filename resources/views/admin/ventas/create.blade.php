@extends('adminlte::page')

@section('title', 'Gestión - Ventas')

@section('content_header')
    <h1>
      Gestionar Ventas
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('articulos.index')}}">Ventas</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nueva Venta</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'ventas.store']) !!}

			  @include('admin.ventas.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection