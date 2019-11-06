@extends('adminlte::page')

@section('title', 'Gestión - Asignar Stock')

@section('content_header')
  <h1>
    Gestionar Asignaciones de Stock
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('stockasignaciones.index')}}">Asignar Stock</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Asignaciones</strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'stockasignaciones.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.complementotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('stockasignaciones.create')}}" class="form-control btn btn-sm btn-primary">
			        <span class="glyphicon glyphicon-plus"></span> Crear
			      </a>  
			      @endif
				  <a target="_blank" href="{{ asset('printstockventaactual/') }}" class="form-control btn btn-sm btn-warning" data-toggle="tooltip" title="Ver Stock Actual">
			        <span class="glyphicon glyphicon-print"></span>
			      </a> 
			    </div>
		    {{ Form::close() }}
      </form>
	</div>
		
	<div class="panel-body">
	    <div class="panel-body">
	        <div class="row">
	          <div class="table-responsive">
	            <table class="table table-striped table-hover" data-form="Form">
	              <thead>
	                <tr>
	                  <!--<th width="10px"> ID</th>-->
	                  <th> Codigo Asignacion</th>
	                  <th> Empleado</th>
					  <th> Fecha</th>
					  <th> Estado</th>
	                  <th colspan="2">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($stockasignaciones as $stockasignacion)
	                  <tr>
	                    <td>{{ $stockasignacion->id }}</td>
	                    <td>{{ $stockasignacion->empleado->empleado }}</td>
						<td>{{ $stockasignacion->fecha }}</td>
						<td>
							@if($stockasignacion->estado == 1) 
								En Repartición
							@else
								Procesado
							@endif
						</td>
						<!--
						<td width="10px">
	                    	<a  href="{{ asset('printstocksignacion/') . '/' . $stockasignacion->id }}" target="blank_" class='btn btn-sm btn-success' title="Imprimir Hoja de Ruta">
		                   		<span class='glyphicon glyphicon-print'></span>
		                   	</a>
						</td>
						-->
	                    </td>
	                    <td width="10px">
	                      <a href="{{ route('stockasignaciones.show', $stockasignacion->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    
	                    @if($permiso == 2) 
		                   
		                    <td width="10px">
		                      	@if($stockasignacion->estado == 1)
				                    <a href="{{ route('stockasignaciones.edit', $stockasignacion->id) }}" class="btn btn-sm btn-default">
				                        Procesar
				                    </a>
		                      	@endif
		                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $stockasignaciones->firstItem() . ' a ' . $stockasignaciones->lastItem() . ' de ' . $stockasignaciones->total() . ' registros'; ?>	</div>
	          {{ $stockasignaciones->appends(Request::only(['type', 'val']))->render() }}
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">


	$('#type').change(function(e) {

		$('#val').val('');
		$('#val').focus();

	});
		
	</script>
@endpush