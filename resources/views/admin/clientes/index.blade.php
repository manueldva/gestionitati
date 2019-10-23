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
	   <strong> Listado Clientes  </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val', 'val2', 'barrios', 'calles' , 'tipoclientes', 'estados'), array('route' => 'clientes.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.clientetypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
					&nbsp;
				   <span id="calle" class="form-group">
						{{ Form::select('calles',$calles, null, ['class'=>'form-control', 'id' => 'calles']) }}
				  </span>
				   <span id="barrio" class="form-group">
						{{ Form::select('barrios', $barrios, null, ['class'=>'form-control', 'id' => 'barrios','placeholder' => 'Seleccionar...']) }}
				  </span>
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
			      {{ form::text('val2', null, ['class' => 'form-control', 'id' => 'val2']) }}
			     
				  <span id="estado" class="form-group">
						{{ Form::select('estados',['1'=> 'Activo', '0'=>'Inactivo'], null, ['class'=>'form-control', 'id' => 'estados']) }}
				  </span>
				   <span id="tipocliente" class="form-group">
						{{ Form::select('tipoclientes', $tipoclientes, null, ['class'=>'form-control', 'id' => 'tipoclientes','placeholder' => 'Seleccionar...']) }}
				  </span>
			      &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
					&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('clientes.create')}}" class="form-control btn btn-sm btn-primary">
			        <span class="glyphicon glyphicon-plus"></span> Crear
			      </a>  
			      @endif
			      
			    </div>
		    {{ Form::close() }}
      </form>
	</div>
	
	<div class="panel-body">
		<div>
    		<h3><strong> <?php  echo ' Total de Clientes: ' . $clientes->total(); ?></strong></h3>
    		
  		</div>
  		<div>
  			&nbsp;
	      	<a target="_blank" href="#" id="imprimir" class="pull-right"> 
                <button  type="button" class="btn btn btn-primary"><span class="glyphicon glyphicon-print"></span> Imprimir </button>
            </a>
  		</div>
  		<br>
	    <div class="panel-body">

	        <div class="row">
	          <div class="table-responsive">
	            <table class="table table-striped table-hover" data-form="Form">
	              <thead>
	                <tr>
	                  <!--<th width="10px"> ID</th>-->
	                  <th> Nro Cliente</th>
					  <th> Cliente</th>
	                  <th> Tipo Cliente</th>
	                  <th>Direccion</th>
	                  <th>Celular</th>
	                  <th>Estado</th>
	                  <th colspan="2">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>

	                @foreach ($clientes as $cliente)
	                  <tr>
						<td>
							@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
								<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
									{{ $cliente->cliente->id }}
								</a>
							@else
								<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
									{{ $cliente->id }}
								</a>
							@endif
						</td>
						<td>
							@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
								<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
									@if($cliente->cliente->tipocliente_id == 1)
										{{ $cliente->cliente->apellido }} {{ $cliente->cliente->nombre }}
									@else

										{{ $cliente->cliente->cliente }}
									@endif
								</a>
							@else
								<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
									@if($cliente->tipocliente_id == 1)
										{{ $cliente->apellido }} {{ $cliente->nombre }}
									@else

										{{ $cliente->cliente }}
									@endif
								</a>
							@endif
							
						</td>
	                    <td>
	                    	@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
		                    	@if($cliente->cliente->tipocliente_id !== null)
		                    	<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
		                    	{{ $cliente->cliente->tipocliente->descripcion }}
		                    	</a>
		                    	@endif
		                    @else
								@if($cliente->tipocliente_id !== null)
		                    	<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
		                    	{{ $cliente->tipocliente->descripcion }}
		                    	</a>
		                    	@endif
							@endif
	                    </td>
	                    <td>
	                    	@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
		                    	@if($cliente->usuario_modi !== null)
		                    	<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
		                    	{{ $cliente->usuario_modi }}
		                    	</a>
		                    	@endif
		                     @else
								@if($cliente->usuario_modi !== null)
		                    	<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
		                    	{{ $cliente->usuario_modi }}
		                    	</a>
		                    	@endif
							@endif
	                    </td>
						<td>
							@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
								<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
									{{ $cliente->cliente->celular }}
								</a>
							 @else
								<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
									{{ $cliente->celular }}
								</a>
							@endif
						</td>	
						<td>
							@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
								<a href="{{ route('clientes.show', $cliente->cliente->id) }}" style="color:#000000;">
									@if($cliente->cliente->estado == 0)
										Inactivo
									@else
										Activo
									@endif
								</a>
							 @else
								<a href="{{ route('clientes.show', $cliente->id) }}" style="color:#000000;">
									@if($cliente->estado == 0)
										Inactivo
									@else
										Activo
									@endif
								</a>
							@endif
						</td>	

	                    
	                    @if($permiso == 2) 
							<td width="10px">
								@if(!Auth::user()->empleado_id)
									@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
										<a href="{{ route('clientes.edit', $cliente->cliente->id) }}" class="btn btn-sm btn-default">
										Editar
										</a>
									@else
										<a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-default">
										Editar
										</a>
									@endif
								@elseif($cliente->sucursal_id == Auth::user()->empleado->sucursal_id)
									@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
										<a href="{{ route('clientes.edit', $cliente->cliente->id) }}" class="btn btn-sm btn-default">
										Editar
										</a>
									@else
										<a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-default">
										Editar
										</a>
									@endif
								@endif
							</td>
							<td  width="10px">
								@if($cliente->estado !== 0)
									@if ($typetemp == 'barrio' || $typetemp == 'callenumero' || $typetemp == 'mzcasa')
										<a href="{{ route('cuentacorrientes.edit', $cliente->cliente->id) }}" class="btn btn-sm btn-default">
											Cuenta C.
										</a>
									@else
										<a href="{{ route('cuentacorrientes.edit', $cliente->id) }}" class="btn btn-sm btn-default">
											Cuenta C.
										</a>
									@endif
								@endif
							</td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div> 

			  <div>
			  	<strong> <?php echo  'Mostrando ' . $clientes->firstItem() . ' a ' . $clientes->lastItem() . ' de ' . $clientes->total() . ' registros'; ?>	</div>
	          			{{ $clientes->appends(Request::only(['type', 'val', 'val2' ,'barrios', 'calles', 'tipoclientes', 'estados']))->render() }}
	      		</strong>
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">


		$('#barrios').select2();
		$('#tipoclientes').select2();
 		$('#calles').select2();

		function searchType(){ 
		  var type = $('#type').val();
			
			if (type == 'nrodocumento'){
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#estado').hide();
				$('#tipocliente').hide();
				$('#calle').hide();

				$('#val').attr('type','number');
			} else if (type == 'apellido')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#estado').hide();
				$('#tipocliente').hide();
				$('#calle').hide();

				$('#val').attr('type','text');
			} else if (type == 'cliente')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#estado').hide();
				$('#tipocliente').hide();
				$('#calle').hide();

				$('#val').attr('type','text');
			} else if (type == 'codigo')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#estado').hide();
				$('#tipocliente').hide();
				$('#calle').hide();

				$('#val').attr('type','number');
			} else if (type == 'nombre')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#tipocliente').hide();
				$('#calle').hide();

				$('#val').attr('type','text');	
			} else if (type == 'apellidonombre')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').show();
				$('#barrio').hide();
				$('#tipocliente').hide();
				$('#estado').hide();
				$('#calle').hide();

				$('#val').attr('type','text');
			}else if (type == 'barrio')
			{
				$('#imprimir').hide();
				$('#val').hide();
				$('#val2').hide();
				$('#barrio').show();
				$('#tipocliente').hide();
				$('#estado').hide();
				$('#calle').hide();

				$('#val').attr('type','text');
			}else if (type == 'tipocliente')
			{
				$('#imprimir').hide();
				$('#val').hide();
				$('#val2').hide();
				$('#barrio').hide();
				$('#tipocliente').show();
				$('#estado').hide();
				$('#calle').hide();

				$('#val').attr('type','text');
			}else if (type == 'estado')
			{
				$('#imprimir').hide();
				$('#val').hide();
				$('#val2').hide();
				$('#barrio').hide();
				$('#tipocliente').hide();
				$('#estado').show();
				$('#calle').hide();
				$('#val').attr('type','text');
			}else if (type == 'callenumero')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#tipocliente').hide();
				$('#estado').hide();
				$('#calle').show();
				$('#val').attr('type','number');

			}else if (type == 'mzcasa')
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').show();
				$('#barrio').show();
				$('#tipocliente').hide();
				$('#estado').hide();
				$('#calle').hide();
				$('#val').attr('type','text');

			} else
			{
				$('#imprimir').hide();
				$('#val').show();
				$('#val2').hide();
				$('#barrio').hide();
				$('#tipocliente').hide();
				$('#calle').hide();
				$('#estado').hide();
				$('#val').attr('type','text');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			$('#val2').val('');
			$('#barrios').val('').select2();
			$('#calles').val('').select2();
			$('#tipoclientes').val('').select2();
			//$('#cajas').val($('#cajas option:first').val());
			

		});


		$('#imprimir').on('click', function(e){
            
            var barrio = $("#barrios option:selected").attr("value")
            //alert(barrio);
            if (barrio !== '')
            {
                e.preventDefault();
            	window.open("{{url('detalleclienteprint')}}/"+ barrio);
            } else {
            	return false;
            }


        });

		
	</script>
@endpush