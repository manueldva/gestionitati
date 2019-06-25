@extends('adminlte::page')

@section('title', 'Gestión - Hoja de Ruta')

@section('content_header')
  <h1>
    Gestionar Hoja de Ruta
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('hojarutas.index')}}">Hoja de Ruta</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Hojas de Ruta  </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val', 'empleados'), array('route' => 'hojarutas.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.hojarutatypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
					&nbsp;
			      {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
				   <span id="empleado" class="form-group">
						{{ Form::select('empleados', $empleados, null, ['class'=>'form-control', 'id' => 'empleados','placeholder' => 'Seleccionar...']) }}
				  </span>
			      &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
					&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('hojarutas.create')}}" class="form-control btn btn-sm btn-primary">
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
	                  <th> Codigo Hoja Ruta</th>
	                  <th> Empleado</th>
					  <th> Fecha</th>
	                  <th> Estado</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>

	                @foreach ($hojarutas as $hojaruta)
	                  <tr>
	                  	<td>
							<a href="{{ route('hojarutas.show', $hojaruta->id) }}" style="color:#000000;">
								{{ $hojaruta->id }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutas.show', $hojaruta->id) }}" style="color:#000000;">
								{{ $hojaruta->empleado->empleado }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutas.show', $hojaruta->id) }}" style="color:#000000;">
								{{ $hojaruta->fecha }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutas.show', $hojaruta->id) }}" style="color:#000000;">
								@if($hojaruta->estado == 1)
									En Repartición
								@else
									Cerrada
								@endif
							</a>
						</td>
	                    <td width="10px">
	                    	<a  href="{{ asset('printhojaruta/') . '/' . $hojaruta->id }}" target="blank_" class='btn btn-sm btn-success' title="Imprimir Hoja de Ruta">
						                   		<span class='glyphicon glyphicon-print'></span>
						                   	</a>
						</td>
	                    @if($permiso == 2) 
	                    	@if($hojaruta->estado == 1)
			                    <td width="10px">
			                      <a href="{{ route('hojarutas.edit', $hojaruta->id) }}" class="btn btn-sm btn-default">
			                        Cerrar Hoja
			                      </a>
			                    </td>
			                    <td width="10px">
			                    	
										{!! Form::model($hojaruta, ['method' => 'delete', 'route' => ['hojarutas.destroy', $hojaruta->id], 'class' =>'form-inline form-delete']) !!}
										{!! Form::hidden('id', $hojaruta->id) !!}
										{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
										{!! Form::close() !!}
			                    </td>
		                    @endif
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div> 

			  <div>
			  	<strong> <?php echo  'Mostrando ' . $hojarutas->firstItem() . ' a ' . $hojarutas->lastItem() . ' de ' . $hojarutas->total() . ' registros'; ?>	</div>
	          			{{ $hojarutas->appends(Request::only(['type', 'val' ,'empleados']))->render() }}
	      		</strong>
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">


		$('#empleados').select2();
 
		function searchType(){ 
		  var type = $('#type').val();
			
			if (type == 'fecha'){
				$('#val').show();
				$('#empleado').hide();
				$('#val').attr('type','date');
			} else if (type == 'empleado')
			{
				$('#val').hide();
				$('#empleado').show();
				$('#val').attr('type','date');
			} else
			{
				$('#val').show();
				$('#empleado').hide();
				$('#val').attr('type','date');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			$('#empleados').val('').select2();
			//$('#cajas').val($('#cajas option:first').val());
			

		});


		/*$('#imprimir').on('click', function(e){
            
            var barrio = $("#barrios option:selected").attr("value")
            //alert(barrio);
            if (barrio !== '')
            {
                e.preventDefault();
            	window.open("{{url('detalleclienteprint')}}/"+ barrio);
            } else {
            	return false;
            }


        });*/

		
	</script>
@endpush