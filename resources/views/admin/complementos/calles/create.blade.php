@extends('adminlte::page')

@section('title', 'Gestión - Calles')

@section('content_header')
    <h1>
      Gestionar Calles
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('calles.index')}}">Calles</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Calles</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'calles.store']) !!}

				@include('admin.complementos.calles.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection