@extends('adminlte::page')

@section('title', 'Gestión - Articulos')

@section('content_header')
  <h1>
    Gestionar Articulos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('articulos.index')}}">Articulos</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Articulos </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'articulos.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.articulotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
			      
						&nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if(Auth::user()->userType !== 'READONLY')
			      <a href="{{ route('articulos.create')}}" class="form-control btn btn-sm btn-primary">
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
	                  <th> Nro Articulo</th>
	                  <th> Codigo</th>
	                  <th> Descipcion</th>
										<th> Rubro </th>
	                  <th> Stock</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($articulos as $articulo)
	                  <tr>
	                    <td>{{ $articulo->id }} </td>
	                    <td>{{ $articulo->codigo }}</td>
	                    <td>{{ $articulo->descripcion }}</td>
											<td> @if($articulo->rubro_id) {{  $articulo->rubro->descripcion }} @endif</td>
											<td>{{ $articulo->stock }}</td>
										
	                    <td width="10px">
	                      <a href="{{ route('articulos.show', $articulo->id) }}" class="btn btn-sm btn-default">
	                        Ver
	                      </a>
	                    </td>
	                    
	                    <td width="10px">
													@if(Auth::user()->userType !== 'READONLY')
															<a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-sm btn-default">
																Editar
															</a>
													@endif
	                    </td>
	                    <td width="10px">
												@if(Auth::user()->userType !== 'READONLY')
													{!! Form::model($articulo, ['method' => 'delete', 'route' => ['articulos.destroy', $articulo->id], 'class' =>'form-inline form-delete']) !!}
													{!! Form::hidden('id', $articulo->id) !!}
													{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
													{!! Form::close() !!}
												@endif
	                    </td>
	                  

	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $articulos->firstItem() . ' a ' . $articulos->lastItem() . ' de ' . $articulos->total() . ' registros'; ?>	</div>
	          {{ $articulos->appends(Request::only(['type', 'val']))->render() }}
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
				$('#val').attr('type','text');
			} else if (type == 'descripcion')
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