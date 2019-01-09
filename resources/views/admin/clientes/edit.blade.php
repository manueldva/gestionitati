@extends('adminlte::page')

@section('title', 'Gym - Clientes')

@section('content_header')

    <h1>
      Gestionar Clientes
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('clientes.index')}}">Clientes</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Cliente</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT', 'files' => true]) !!}
                    
        @include('admin.clientes.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection