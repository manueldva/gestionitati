@extends('adminlte::page')

@section('title', 'Gestión - Tipo Ivas')

@section('content_header')
    <h1>
      Gestionar Tipo Ivas
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('tipoivas.index')}}">Tipo ivas</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Tipo Iva</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'tipoivas.store']) !!}

				@include('admin.complementos.tipoivas.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection