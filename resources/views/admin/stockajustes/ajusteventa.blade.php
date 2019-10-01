@extends('adminlte::page')

@section('title', 'Gestión - Enviar Stock a Venta')

@section('content_header')
    <h1>
      Gestionar Envio Stock
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('stocks.index')}}">Enviar Stock a Venta</a></li>
      <li class="active">Realizar Envio</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Realizar Envio</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

      {!! Form::model($stock, ['route' => ['updateajusteventa', $stock->id], 'method' => 'PUT', 'files' => true, 'id' => 'form']) !!}
  
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

@include('admin.stockajustes.partials.formventa')

{!! Form::close() !!}


@endsection

