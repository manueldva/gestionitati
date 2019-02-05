@extends('adminlte::page')

@section('title', 'Gestión - Tipo Empleado')

@section('content_header')

    <h1>
      Gestionar Tipo Empleado
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('tipoempleados.index')}}">Tipo Empleado</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Tipo Empleado</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($tipoempleado, ['route' => ['tipoempleados.update', $tipoempleado->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.tipoempleados.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection