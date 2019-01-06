@extends('adminlte::page')

@section('title', 'Gestión - Tablero')

@section('content_header')
@if($permiso == 2 )
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


@endsection





@push('js')
	
	
@endpush