@extends('adminlte::page')

@section('title', 'Gestión - Clientes')

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
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

                <button type="submit" class="btn btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                      Guardar
                </button>
               &nbsp;&nbsp;&nbsp;
                <a href="{{ route('clientes.index') }}" type="button" id="contrato" class="btn btn btn-default">
                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
                    <span class="fa fa-file-text">
                    </span>
                      Contrato
                </a>  
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('clientes.index') }}" type="button" id="movimiento" class="btn btn btn-default">
                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
                    <span class="fa fa-list">
                    </span>
                      Movimientos del cliente
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('clientes.index') }}" type="button" id="movimiento" class="btn btn btn-danger">
                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
                    <span class="fa fa-trash-o">
                    </span>
                     Baja definitiva
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">
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

@include('admin.clientes.partials.form')

{!! Form::close() !!}


@endsection

