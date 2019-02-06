@extends('adminlte::page')

@section('title', 'Gestión - Distritos')

@section('content_header')

    <h1>
      Gestionar Distritos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('distritos.index')}}">Distritos</a></li>
      <li class="active">Editar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Distrito</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::model($distrito, ['route' => ['distritos.update', $distrito->id], 'method' => 'PUT']) !!}
                    
        @include('admin.complementos.distritos.partials.form')

      {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection