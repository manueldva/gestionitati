@extends('adminlte::page')

@section('title', 'Gestión - Ajuste de Stock')

@section('content_header')
  <h1>
    Gestionar Ajuste de Stock
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('stocks.index')}}">Ajuste de Stock</a></li>
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
	       {{ Form::model(Request::only('type', 'val', 'val2'), array('route' => 'empleados.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
	       		<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>	
									<td> 
									{{ form::label('tipoproducto', 'Tipo Producto:') }}
									<br>
			    					{{ form::select('tipoproducto', ['0'=>'Todos'], null, ['class' => 'form-control', 'id' => 'tipoproducto'] ) }}
									</td>
									<td>
										{{ form::label('sucursal_id', 'Sucursal:') }}
										<br>
			    						{{ form::select('sucursal_id', $sucursales, null, ['class' => 'form-control', 'id' => 'sucursal_id'] ) }}
									</td>
									<td>
										&nbsp;
									</td>
									<td>
										&nbsp;
									</td>
								</tr>

								<tr>	
									<td> 
										{{ form::label('buscar', 'Tipo Busqueda:') }}
									    <br>
									    {{ form::select('type', config('options.stocktypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
									</td>
									<td>
										{{ form::label('val', '&nbsp;') }}
										<br>
			    						{{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
									</td>
									<td>
										{{ form::label('val', '&nbsp;') }}
										<br>
										<button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
									</td>
									<td>
										@if($permiso == 2)
											{{ form::label('val', '&nbsp;') }}
											<br>
										    <a href="{{ route('stocks.create')}}" class="form-control btn btn-sm btn-primary">
										        <span class="glyphicon glyphicon-plus"></span> Crear
										    </a>  
									    @endif
									</td>
								</tr>
								
							</thead>
						</table>
					</div>
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
	                  <th> Descripcion</th>
	                  <th> Sucursal</th>
	                  <th> Stock Actual</th>
	                  <th> Stock Minimo</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($stocks as $stock)
	                  <tr>
	                    <td>
	                    	<a href="{{ route('stocks.show', $stock->id) }}" style="color:#000000;">
								{{ $stock->id }}
							</a>
	                    </td>
	                    </td>
	                    <td>
	                    	<a href="{{ route('stocks.show', $stock->id) }}" style="color:#000000;">
								{{ $stock->descripcion }}
							</a>
	                    </td>
	                     <td>
	                    	<a href="{{ route('stocks.show', $stock->id) }}" style="color:#000000;">
								{{ $stock->sucursal }}
							</a>
	                    </td>
						<td>
							
							<a href="{{ route('stocks.show', $stock->id) }}" style="color:#000000;">
								{{ $stock->stockactual}}
							</a>
						</td>
						<td>
							
							<a href="{{ route('stocks.show', $stock->id) }}" style="color:#000000;">
								{{ $stock->stockminimo}}
							</a>
						</td>

						
	                    @if($permiso == 2) 
	                    <td width="10px">
	                      <a href="{{ route('stockdetalles.edit', $stock->id) }}" class="btn btn-sm btn-default">
							Ajuste
							</a>
	                    </td>
	                    <td width="10px">
	                      <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-default">
	                        Editar
	                      </a>
	                    </td>
	                    <td width="10px">
							{!! Form::model($stock, ['method' => 'delete', 'route' => ['stocks.destroy', $stock->id], 'class' =>'form-inline form-delete']) !!}
							{!! Form::hidden('id', $stock->id) !!}
							{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
							{!! Form::close() !!}

	                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div>  
						<div> <?php echo  'Mostrando ' . $stocks->firstItem() . ' a ' . $stocks->lastItem() . ' de ' . $stocks->total() . ' registros'; ?>	</div>
	          {{ $stocks->appends(Request::only(['type', 'val', 'val2']))->render() }}
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
			
			if (type == 'descripcion'){
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
			//$('#cajas').val($('#cajas option:first').val());
			

		});
		
	</script>
@endpush