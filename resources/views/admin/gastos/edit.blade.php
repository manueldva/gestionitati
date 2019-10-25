@extends('adminlte::page')

@section('title', 'Gestión - Barrios')

@section('content_header')

    <h1>
      Gestionar Barrios
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('barrios.index')}}">Barrios</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Barrio</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($barrio, ['route' => ['barrios.update', $barrio->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.barrios.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection