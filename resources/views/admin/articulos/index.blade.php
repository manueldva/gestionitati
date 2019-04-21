@extends('adminlte::page')

@section('title', 'Gestión - Productos')

@section('content_header')
  <h1>
    Gestionar Productos
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('articulos.index')}}">Productos</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Productos </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val', 'tipoarticulo'), array('route' => 'articulos.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.articulotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						&nbsp;
				   <span id="tipoarticulos" class="form-group">
						{{ Form::select('tipoarticulo', $tipoarticulos, null, ['class'=>'form-control', 'id' => 'tipoarticulo','placeholder' => 'Seleccionar...']) }}
				  </span>
				  &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						&nbsp;
			      @if($permiso == 2)
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
	          <div class="table-responsive">
	            <table class="table table-striped table-hover" data-form="Form">
	              <thead>
	                <tr>
	                  <!--<th width="10px"> ID</th>-->
	                  <th> Codigo</th>
	                  <th> descripción</th>
					  <th> Tipo Producto</th>
	                  <th colspan="2">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($articulos as $articulo)
	                  <tr>
	                    <td>
	                    	<a href="{{ route('articulos.show', $articulo->id) }}" style="color:#000000;">
								{{ $articulo->id }}
							</a>
	                    </td>
	                    <td>
	                    	<a href="{{ route('articulos.show', $articulo->id) }}" style="color:#000000;">
								{{ $articulo->descripcion }}
							</a>
	                    </td>
						<td>
							<a href="{{ route('articulos.show', $articulo->id) }}" style="color:#000000;">
								{{ $articulo->tipoarticulo->descripcion }}
							</a>
						</td>
	                    
	                    @if($permiso == 2) 
	                    <td width="10px">
	                      <a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-sm btn-default">
	                        Editar
	                      </a>
	                    </td>
	                    <td width="10px">
							{!! Form::model($articulo, ['method' => 'delete', 'route' => ['articulos.destroy', $articulo->id], 'class' =>'form-inline form-delete']) !!}
							{!! Form::hidden('id', $articulo->id) !!}
							{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
							{!! Form::close() !!}

	                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $articulos->firstItem() . ' a ' . $articulos->lastItem() . ' de ' . $articulos->total() . ' registros'; ?>	</div>
	          {{ $articulos->appends(Request::only(['type', 'val', 'tipoarticulo']))->render() }}
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">

		$('#tipoarticulo').select2();

		function searchType(){ 
		  var type = $('#type').val();
			
			if (type == 'codigo'){
				$('#val').show();
				$('#tipoarticulos').hide();
				$('#val').attr('type','number');
			} else if (type == 'descripcion')
			{
				$('#val').show();
				$('#tipoarticulos').hide();
				$('#val').attr('type','text');
			} else if (type == 'tipoarticulo')
			{
				$('#val').hide();
				$('#tipoarticulos').show();
				$('#val').attr('type','number');
			} else
			{
				$('#val').show();
				$('#tipoarticulos').hide();
				$('#val').attr('type','number');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			$('#tipoarticulo').val('').select2();
			//$('#cajas').val($('#cajas option:first').val());
			

		});
		
	</script>
@endpush