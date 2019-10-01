@extends('adminlte::page')

@section('title', 'Gestión - Ajuste de Stock')

@section('content_header')
    <h1>
      Gestionar Ajuste de Stock
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('stocks.index')}}">Ajuste de Stock</a></li>
      <li class="active">Realizar Ajuste</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Realizar Ajuste</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

      {!! Form::model($stock, ['route' => ['stockajustes.update', $stock->id], 'method' => 'PUT', 'files' => true, 'id' => 'form']) !!}
  
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
                </a>-->
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('stockajustes.show', $stock->id) }}" type="button" id="movimiento" class="btn btn btn-default">
                    <span class="fa fa-info">
                    </span>
                     Movimientos
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('stocks.index') }}" type="button" class="btn btn btn-default">
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

@include('admin.stockajustes.partials.form')

{!! Form::close() !!}


@endsection

