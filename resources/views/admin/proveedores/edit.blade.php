@extends('adminlte::page')

@section('title', 'Gestión - Proveedores')

@section('content_header')

    <h1>
      Gestionar Proveedores
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('proveedores.index')}}">Proveedor</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Proveedor</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($proveedor, ['route' => ['proveedores.update', $proveedor->id], 'method' => 'PUT']) !!}
                    
        @include('admin.proveedores.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection