@extends('adminlte::page')

@section('title', 'Gestión - Modelo Contratos')

@section('content_header')
  <h1>
    Gestionar Modelo Contratos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('modelocontratos.index')}}">Modelo Contratos</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Modelo Contratos </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'modelocontratos.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.complementotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('modelocontratos.create')}}" class="form-control btn btn-sm btn-primary">
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
	                  <th> Modelo</th>
					  <th> Descripcion</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($modelocontratos as $modelocontrato)
	                  <tr>
	                    <td>{{ $modelocontrato->id }}</td>
	                    <td>{{ $modelocontrato->modelo }}</td>
						<td>{{ $modelocontrato->descripcion }}</td>
	                    <td width="10px">
	                      <a href="{{ route('modelocontratos.show', $modelocontrato->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    @if($permiso == 2) 
	                    <td width="10px">
	                      <a href="{{ route('modelocontratos.edit', $modelocontrato->id) }}" class="btn btn-sm btn-default">
	                        Editar
	                      </a>
	                    </td>
	                    <td width="10px">
							{!! Form::model($modelocontrato, ['method' => 'delete', 'route' => ['modelocontratos.destroy', $modelocontrato->id], 'class' =>'form-inline form-delete']) !!}
							{!! Form::hidden('id', $modelocontrato->id) !!}
							{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
							{!! Form::close() !!}

	                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $modelocontratos->firstItem() . ' a ' . $modelocontratos->lastItem() . ' de ' . $modelocontratos->total() . ' registros'; ?>	</div>
	          {{ $modelocontratos->appends(Request::only(['type', 'val']))->render() }}
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