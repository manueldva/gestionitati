@extends('adminlte::page')

@section('title', 'Gestión - Gastos')

@section('content_header')

    <h1>
      Gestionar Gastos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('gastos.index')}}">Gastos</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Gasto</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($gasto, ['route' => ['gastos.update', $gasto->id], 'method' => 'PUT']) !!}
                    
        @include('admin.gastos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection