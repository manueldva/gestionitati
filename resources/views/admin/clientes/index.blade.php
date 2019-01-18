@extends('adminlte::page')

@section('title', 'Gestión - Clientes')

@section('content_header')
  <h1>
    Gestionar Clientes
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('clientes.index')}}">Clientes</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Clientes </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'clientes.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.clientetypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
			      &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      {{-- @if($permiso == 2) --}}
			      <a href="{{ route('clientes.create')}}" class="form-control btn btn-sm btn-primary">
			        <span class="glyphicon glyphicon-plus"></span> Crear
			      </a>  
			      {{-- @endif --}}
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
					  <th> Cliente</th>
	                  <th> Tipo Cliente</th>
	                  <th>Domicilio</th>
	                  <th>Celular</th>
	                  <th>Estado</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>

	                @foreach ($clientes as $cliente)
	                  <tr>
						<td>
							<a href="{{ route('clientes.edit', $cliente->id) }}" style="color:#000000;">
								{{ $cliente->id }}
							</a>
						</td>
						<td>
							<a href="{{ route('clientes.edit', $cliente->id) }}" style="color:#000000;">
								{{ $cliente->cliente }}
							</a>
							
						</td>
	                    <td>@if($cliente->tipocliente_id !== null)
	                    	<a href="{{ route('clientes.edit', $cliente->id) }}" style="color:#000000;">
	                    	{{ $cliente->tipocliente->descripcion }}
	                    	</a>
	                    	@endif
	                    </td>
	                    <td>@if($cliente->barrio_id !== null)
	                    	<a href="{{ route('clientes.edit', $cliente->id) }}" style="color:#000000;">
	                    		{{ $cliente->barrio->descripcion }}
	                    	</a>
	                    	@endif
	                    </td>
						<td>
							<a href="{{ route('clientes.edit', $cliente->id) }}" style="color:#000000;">
								{{ $cliente->celular }}
							</a>
						</td>		
	                    <td width="10px">
	                      <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    {{-- @if($permiso == 2) --}}
	                    <td width="10px">
	                      <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-default">
	                        Editar
	                      </a>
	                    </td>
	                    <td width="10px">
							{!! Form::model($cliente, ['method' => 'delete', 'route' => ['clientes.destroy', $cliente->id], 'class' =>'form-inline form-delete']) !!}
							{!! Form::hidden('id', $cliente->id) !!}
							{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
							{!! Form::close() !!}

	                    </td>
	                    {{-- @endif --}}
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $clientes->firstItem() . ' a ' . $clientes->lastItem() . ' de ' . $clientes->total() . ' registros'; ?>	</div>
	          {{ $clientes->appends(Request::only(['type', 'val']))->render() }}
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