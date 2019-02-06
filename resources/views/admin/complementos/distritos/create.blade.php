@extends('adminlte::page')

@section('title', 'Gestión - Distritos')

@section('content_header')
    <h1>
      Gestionar Distritos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('distritos.index')}}">Distritos</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Distrito</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'distritos.store']) !!}

				@include('admin.complementos.distritos.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection