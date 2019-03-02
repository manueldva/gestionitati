@extends('adminlte::page')

@section('title', 'Gestión - Empleados')

@section('content_header')

    <h1>
      Gestionar Empleados
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('empleados.index')}}">Empleados</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Empleado</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($empleado, ['route' => ['empleados.update', $empleado->id], 'method' => 'PUT']) !!}
                    
        @include('admin.empleados.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection