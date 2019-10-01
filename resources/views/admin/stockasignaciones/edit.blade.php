@extends('adminlte::page')

@section('title', 'Gestión - Asignar Stock')

@section('content_header')

    <h1>
      Gestionar Asignaciones de Stock
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('stockasignaciones.index')}}">Sucursales</a></li>
      <li class="active">Procesar</li>
    </ol>

@stop

@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Procesar Asignación</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

      {!! Form::model($stockasignacion, ['route' => ['stockasignaciones.update', $stockasignacion->id], 'method' => 'PUT', 'files' => true, 'id' => 'form']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

                <button id="guardar" type="button"  class="btn btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                      Guardar
                </button>

                <!-- 
                &nbsp;&nbsp;&nbsp;
                <a href="#" type="button" id="movimiento" class="btn btn btn-default">
                    <span class="fa fa-list">
                    </span>
                      Movimientos del cliente
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="#" type="button" id="movimiento" class="btn btn btn-danger">
                    <span class="fa fa-trash-o">
                    </span>
                     Baja definitiva
                </a>-->
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('stockasignaciones.index') }}" type="button" class="btn btn btn-default">
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

@include('admin.stockasignaciones.partials.formedit')

{!! Form::close() !!}


@endsection

