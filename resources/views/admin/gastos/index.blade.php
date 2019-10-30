@extends('adminlte::page')

@section('title', 'Gestión - Gastos')

@section('content_header')
  <h1>
    Gestionar Gastos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('gastos.index')}}">Gastos</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Gastos </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'gastos.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.ventatypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('gastos.create')}}" class="form-control btn btn-sm btn-primary">
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
					  <th> Fecha</th>
	                  <th> Rubro</th>
	  				  <th> Monto</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($gastos as $gasto)
	                  <tr>
	                    <td>{{ $gasto->id }}</td>
						<td>{{ $gasto->fecha }}</td>
						<td>@if($gasto->rubrogasto_id)
								{{ $gasto->rubrogasto->descripcion  }}
							@endif
						</td>
	                    <td>{{ $gasto->monto }}</td>
	                    <td width="10px">
	                      <a href="{{ route('gastos.show', $gasto->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    @if($permiso == 2)
	                    <td width="10px">
	                      <a href="{{ route('gastos.edit', $gasto->id) }}" class="btn btn-sm btn-default">
	                        Editar
	                      </a>
	                    </td>
	                    <td width="10px">
							{!! Form::model($gasto, ['method' => 'delete', 'route' => ['gastos.destroy', $gasto->id], 'class' =>'form-inline form-delete']) !!}
							{!! Form::hidden('id', $gasto->id) !!}
							{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
							{!! Form::close() !!}

	                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
				<div> <?php echo  'Mostrando ' . $gastos->firstItem() . ' a ' . $gastos->lastItem() . ' de ' . $gastos->total() . ' registros'; ?>	</div>
	          {{ $gastos->appends(Request::only(['type', 'val']))->render() }}
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
				$('#val').attr('type','number');
			} else if (type == 'fecha'){
				$('#val').show();
				$('#val').attr('type','date');
			} else
			{
				$('#val').show();
				$('#val').attr('type','number');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			//$('#cajas').val($('#cajas option:first').val());
			

		});
		
		
	</script>
@endpush