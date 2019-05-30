@extends('adminlte::page')

@section('title', 'Gestión - Empleados')

@section('content_header')
  <h1>
    Gestionar Empleados
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('empleados.index')}}">Empleados</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Empleados </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val', 'val2'), array('route' => 'empleados.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.empleadotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						&nbsp;
				  {{ form::text('val2', null, ['class' => 'form-control', 'id' => 'val2']) }}
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('empleados.create')}}" class="form-control btn btn-sm btn-primary">
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
	          <div class="table-responsive">
	            <table class="table table-striped table-hover" data-form="Form">
	              <thead>
	                <tr>
	                  <!--<th width="10px"> ID</th>-->
	                  <th> Codigo</th>
	                  <th> Apellido y Nombre</th>
	                  <th> Sucursal</th>
	                  <th> Tipo Empleado</th>
	                  <th> Estado</th>
	                  <th colspan="4">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($empleados as $empleado)
	                  <tr>
	                    <td>
	                    	<a href="{{ route('empleados.show', $empleado->id) }}" style="color:#000000;">
								{{ $empleado->id }}
							</a>
	                    </td>
	                    </td>
	                    <td>
	                    	<a href="{{ route('empleados.show', $empleado->id) }}" style="color:#000000;">
								{{ $empleado->apellido }} {{ $empleado->nombre }}
							</a>
	                    </td>
						<td>
							@if($empleado->sucursal)
								<a href="{{ route('empleados.show', $empleado->id) }}" style="color:#000000;">
									{{ $empleado->sucursal->descripcion }}
								</a>
							@endif
						</td>
						<td>
							
							<a href="{{ route('empleados.show', $empleado->id) }}" style="color:#000000;">
								{{ $empleado->tipoempleado->descripcion}}
							</a>
						</td>
						<td>
							
							<a href="{{ route('empleados.show', $empleado->id) }}" style="color:#000000;">
								@if($empleado->fechaegreso)
									Inactivo
								@else
									Activo
								@endif
							</a>
						</td>
						@if($permiso == 2) 
							<td width="10px">
		                      @if($empleado->tipoempleado_id == 1)
			                      <a href="{{ route('empleadotransferir', $empleado->id) }}" class="btn btn-sm btn-default">
			                        Transferir C.
			                      </a>
			                    @endif
		                    </td>
		                @endif
						@if($permiso_user == 2) 
	                    	<td width="10px">
		                      <a href="{{ route('manageusers.edit', $empleado->user->id) }}" class="btn btn-sm btn-default">
								Usuario
								</a>
		                    </td>
	                    @endif
	                    @if($permiso == 2) 
		                    <td width="10px">
		                      <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-default">
		                        Editar
		                      </a>
		                    </td>
		                    <td width="10px">
								{!! Form::model($empleado, ['method' => 'delete', 'route' => ['empleados.destroy', $empleado->id], 'class' =>'form-inline form-delete']) !!}
								{!! Form::hidden('id', $empleado->id) !!}
								{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
								{!! Form::close() !!}

		                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $empleados->firstItem() . ' a ' . $empleados->lastItem() . ' de ' . $empleados->total() . ' registros'; ?>	</div>
	          {{ $empleados->appends(Request::only(['type', 'val', 'val2']))->render() }}
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">


	function searchType(){ 
		  var type = $('#type').val();
			
			if (type == 'codigo'){
				$('#val').show();
				$('#val2').hide();
				$('#val').attr('type','number');
			} else if (type == 'apellido')
			{
				$('#val').show();
				$('#val2').hide();
				$('#val').attr('type','text');
			}else if (type == 'nombre')
			{
				$('#val').show();
				$('#val2').hide();
				$('#val').attr('type','text');
			}else if (type == 'apellidonombre')
			{
				$('#val').show();
				$('#val2').show();
				$('#val').attr('type','text');
			} else
			{
				$('#val').show();
				$('#val2').hide();
				$('#val').attr('type','text');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			$('#val2').val('');
			//$('#cajas').val($('#cajas option:first').val());
			

		});
		
	</script>
@endpush