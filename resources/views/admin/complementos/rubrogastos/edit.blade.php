@extends('adminlte::page')

@section('title', 'Gestión - Rubro Gastos')

@section('content_header')

    <h1>
      Gestionar Rubro Gastos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('rubrogastos.index')}}">Rubro Gastos</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Rubro Gasto</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($rubrogasto, ['route' => ['rubrogastos.update', $rubrogasto->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.rubrogastos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection