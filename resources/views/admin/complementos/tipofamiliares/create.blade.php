@extends('adminlte::page')

@section('title', 'Gestión - Tipo Familiar')

@section('content_header')
    <h1>
      Gestionar Tipo Familiar
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('tipofamiliares.index')}}">Tipo Familiar</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Tipo Familiar</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'tipofamiliares.store']) !!}

				@include('admin.complementos.tipofamiliares.partials.form')

			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection