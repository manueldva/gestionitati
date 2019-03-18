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
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Modelo Contrato</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($modelocontrato, ['route' => ['modelocontratos.update', $modelocontrato->id], 'method' => 'PUT']) !!}
                    
        @include('admin.modelocontratos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection