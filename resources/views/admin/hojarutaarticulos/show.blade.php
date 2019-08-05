@extends('adminlte::page')

@section('title', 'Gestión - Hoja de Ruta')

@section('content_header')
    <h1>
      Gestionar Hoja de Ruta
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('hojarutas.index')}}">Hoja de Ruta</a></li>
      <li class="active">Cerrar Hoja</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Cerrar Hoja de Ruta</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

      {!! Form::model($hojaruta, ['route' => ['hojarutas.show', $hojaruta->id], 'method' => 'GET']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

              
                <a href="{{ route('hojarutas.index') }}" type="button" class="btn btn btn-default">
                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
                    <span class="fa fa-list">
                    </span>
                      Listado
                </a>
                 
            </div>
          </div>
        </div>
       
      
    </div>
  </div>
</div>

@include('admin.hojarutas.partials.formshow')

{!! Form::close() !!}


@endsection

