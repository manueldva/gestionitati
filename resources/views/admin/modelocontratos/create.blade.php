@extends('adminlte::page')

@section('title', 'Gestión - Modelo Contratos')

@section('css')
  <link rel="stylesheet" href="{{ asset('editor/summernote.css') }}">
@endsection

@section('content_header')
    <h1>
      Gestionar Modelo Contratos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('modelocontratos.index')}}">Modelo Contratos</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Modelo Contrato</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'modelocontratos.store']) !!}

				@include('admin.modelocontratos.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection