@extends('adminlte::page')

@section('title', 'Gestión - Proveedores')


@section('css')
	
@endsection


@section('content_header')
  <h1>
    Gestionar Proveedores
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('proveedores.index')}}">Proveedores</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Proveedor </strong>
	</div>
		
	<div class="panel-body">
	    	<div class="row">
					<div class="col-md-12">
						<div class="row col-md-12">
							<div class="form-group pull-right">
										<a href="{{ route('proveedores.index') }}" type="button" class="btn btn btn-default">
											<span class="fa fa-list">
											</span>
												Listado
										</a>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						
						<p> <strong>Nombre:</strong> {{ $proveedor->nombre}}</p>

						@if($proveedor->nombrecontacto)
							<p> <strong>Nombre Contacto:</strong> {{ $proveedor->nombrecontacto }}</p>
						@endif

						@if($proveedor->domicilio)
							<p> <strong>Domicilio:</strong> {{ $proveedor->domicilio }}</p>
						@endif

						@if($proveedor->telefono)
							<p> <strong>Telefono:</strong> {{ $proveedor->telefono }}</p>
						@endif

						@if($proveedor->celular)
							<p> <strong>Celular:</strong> {{ $proveedor->celular }}</p>
						@endif

						@if($proveedor->email)
							<p> <strong>Email:</strong> {{ $proveedor->email }}</p>
						@endif

						@if($proveedor->observaciones)

							<p> <strong>Observaciones:</strong> {{ $proveedor->observaciones }}</p>
						@endif

						<p> <strong>Estado:</strong> {{ $proveedor->estado }}</p>
						

						
					</div>

				</div>
	</div>
</div>

@endsection





@push('js')
	
	<script type="text/javascript">

		
		
	</script>
@endpush

           
             