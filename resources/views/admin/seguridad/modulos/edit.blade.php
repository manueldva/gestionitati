@extends('adminlte::page')

@section('title', 'Gestion - Modulos')

@section('content_header')

    <h1>
      Gestionar Modulos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('modulos.index')}}">Modulos</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Modulo</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($modulo, ['route' => ['modulos.update', $modulo->id], 'method' => 'PUT']) !!}
                    
        @include('admin.seguridad.modulos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection