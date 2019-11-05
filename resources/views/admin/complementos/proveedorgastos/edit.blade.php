@extends('adminlte::page')

@section('title', 'Gestión - Proveedor Gastos')

@section('content_header')

    <h1>
      Gestionar Proveedor Gastos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('proveedorgastos.index')}}">Proveedor Gastos</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Proveedor Gasto</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($proveedorgasto, ['route' => ['proveedorgastos.update', $proveedorgasto->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.proveedorgastos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection