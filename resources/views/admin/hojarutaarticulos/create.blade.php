@extends('adminlte::page')

@section('title', 'Gestión - Hoja de Ruta por Articulo')
  
@section('css')
 
@endsection

@section('content_header')
    <h1>
      Gestionar Hoja de Ruta por Articulo
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('hojarutaarticulos.index')}}">Hoja de Ruta por Articulo</a></li>
      <li class="active">Nueva Hoja de Ruta por Articulo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nueva Hoja de Ruta por Articulo</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

  {!! Form::open(['route' => 'hojarutaarticulos.store', 'files' => true, 'id' => 'form']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

                <button id="guardar" type="button" class="btn btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                      Guardar
                </button>
                 &nbsp;&nbsp;&nbsp;

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

@include('admin.hojarutaarticulos.partials.form')

{!! Form::close() !!}


@endsection


@push('js')

  <script type="text/javascript">
    
  </script>
@endpush