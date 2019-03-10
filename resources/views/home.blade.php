@extends('adminlte::page')

@section('title', 'Gestión - Tablero')

@section('content_header')
  @if($permiso !== 0 ) 
    <h1>
      Tablero
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Tablero</li>
    </ol>
  @endif
@stop


@section('include_delete')
	
@stop

@section('content')	
@if($permiso !== 0 ) 
<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong></strong>
  </div>
    
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
    
          <div class="small-box  bg-green"> 
            <!--<div class="small-box bg-green">-->
            <div class="inner">
              <h3>{{ $contratos }} </h3>

              <p>Contratos Registrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a   href="{{ route('detalleinformecontratos') }}"  class="small-box-footer">Ver Detalle Por Barrio <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
  </div>
</div>
@endif
@endsection





@push('js')
	
	
@endpush