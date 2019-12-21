@extends('adminlte::page')

@section('title', 'Gestión - Hoja de Ruta Por Articulo')

@section('content_header')
    <h1> 
      Gestionar Hoja de Ruta Por Articulo
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('hojarutaarticulos.index')}}">Hoja de Ruta Por Articulo</a></li>
      <li class="active">Ver Hoja Por Articulo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Ver Hoja de Ruta Por Articulo</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

      {!! Form::model($hojarutaarticulo, ['route' => ['hojarutaarticulos.show', $hojarutaarticulo->id], 'method' => 'GET']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

              
                <a href="{{ route('hojarutaarticulos.index') }}" type="button" class="btn btn btn-default">
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

@include('admin.hojarutaarticulos.partials.formshow')

{!! Form::close() !!}


@endsection

