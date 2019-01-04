@extends('adminlte::page')

@section('title', 'Gestión - Proveedores')

@section('content_header')
  <h1>
    Gestionar Proveedores
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('proveedores.index')}}">Proveedores</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Proveedores </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'proveedores.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.proveedortypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
			     	
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if(Auth::user()->userType !== 'READONLY')
			      <a href="{{ route('proveedores.create')}}" class="form-control btn btn-sm btn-primary">
			        <span class="glyphicon glyphicon-plus"></span> Crear
			      </a>  
			      @endif
			    </div>
		    {{ Form::close() }}
      </form>
	</div>
		
	<div class="panel-body">
	    <div class="panel-body">
	        <div class="row">
	          <div class="table-responsive" >
	            <table class="table table-striped table-hover tablesorter" data-form="Form" id="index">
	              <thead>
	                <tr>
	                  <th> Nombre</th>
	                  <th> Nombre Contacto</th>
	                  <th> Domicilio</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($proveedores as $proveedor)
	                  <tr>
	                    <td>{{ $proveedor->nombre }} </td>
	                    <td>{{ $proveedor->nombrecontacto }}</td>
											<td>{{ $proveedor->domicilio }}</td>
	                   
	                    <td width="10px">
	                      <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    
	                    <td width="10px">
													@if(Auth::user()->userType !== 'READONLY')
														<a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-default">
															Editar
														</a>
													@endif
	                    </td>
	                    <td width="10px">
												@if(Auth::user()->userType !== 'READONLY')
													{!! Form::model($proveedor, ['method' => 'delete', 'route' => ['proveedores.destroy', $proveedor->id], 'class' =>'form-inline form-delete']) !!}
													{!! Form::hidden('id', $proveedor->id) !!}
													{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
													{!! Form::close() !!}
												@endif
	                    </td>
	                  

	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $proveedores->firstItem() . ' a ' . $proveedores->lastItem() . ' de ' . $proveedores->total() . ' registros'; ?>	</div>
	          {{ $proveedores->appends(Request::only(['type', 'val']))->render() }}
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>
	<script src="{{ asset('js/resources/jquery.tablesorter.min.js') }}"></script> 

	<script type="text/javascript">

		
		function searchType(){ 
		   var type = $('#type').val();
			if (type == 'codigo'){
				$('#val').show();
				$('#val').attr('type','number');
			} else if (type == 'nombre')
			{
				$('#val').show();
				$('#val').attr('type','text');
			} else
			{
				$('#val').show();
				$('#val').attr('type','text');
			}
		}

		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
		});



		/*$(document).ready(function() 
		{ 
			$("#index").tablesorter( {sortList: [[0,0]]} ); 
		} 
		); */
		
	</script>
@endpush