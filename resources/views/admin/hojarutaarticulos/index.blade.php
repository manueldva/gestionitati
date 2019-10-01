@extends('adminlte::page')

@section('title', 'Gestión - Hoja de Ruta por Articulo')

@section('content_header')
  <h1>
    Gestionar Hoja de Ruta por Articulo
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('hojarutas.index')}}">Hoja de Ruta por Articulo</a></li>
    <li class="active">Listado</li>
  </ol>

@stop


@section('include_delete')
	@include('include.modal-delete')
@stop

@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Listado Hojas de Ruta por Articulo  </strong>
	   <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('type', 'val'), array('route' => 'hojarutaarticulos.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Tipo Busqueda:') }}
			      {{ form::select('type', config('options.hojarutaartoculotypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
			      &nbsp;
			       {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
			       &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
					&nbsp;
			      @if($permiso == 2)
			      <a href="{{ route('hojarutaarticulos.create')}}" class="form-control btn btn-sm btn-primary">
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
					  <th> Fecha</th>
					  <th> Articulo</th>
	                  <th> Estado</th>
	                  <th colspan="3">&nbsp;</th>
	                </tr>
	              </thead>
	              <tbody>

	                @foreach ($hojarutaarticulos as $hojarutaarticulo)
	                  <tr>
	                  	<td>
							<a href="{{ route('hojarutaarticulos.show', $hojarutaarticulo->id) }}" style="color:#000000;">
								{{ $hojarutaarticulo->id }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutaarticulos.show', $hojarutaarticulo->id) }}" style="color:#000000;">
								{{ $hojarutaarticulo->fecha }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutaarticulos.show', $hojarutaarticulo->id) }}" style="color:#000000;">
								{{ $hojarutaarticulo->articulo->descripcion }}
							</a>
						</td>
						<td>
							<a href="{{ route('hojarutaarticulos.show', $hojarutaarticulo->id) }}" style="color:#000000;">
								@if($hojarutaarticulo->estado == 1)
									Abierta
								@else
									Cerrada
								@endif
							</a>
						</td>
	                    <td width="10px">
	                    	<a  href="{{ asset('printhojarutaarticulo/') . '/' . $hojarutaarticulo->id }}" target="blank_" class='btn btn-sm btn-success' title="Imprimir Hoja de Ruta">
						                   		<span class='glyphicon glyphicon-print'></span>
						                   	</a>
						</td>
	                    @if($permiso == 2) 
	                    	
		                    <td width="10px">
		                    	@if($hojarutaarticulo->estado == 1)
		                      <a href="{{ route('hojarutaarticulos.edit', $hojarutaarticulo->id) }}" class="btn btn-sm btn-default">
		                        Porcesar
		                      </a>
		                       	@endif
		                    </td>
		                  	
			               	 <td width="10px">
								{!! Form::model($hojarutaarticulo, ['method' => 'delete', 'route' => ['hojarutaarticulos.destroy', $hojarutaarticulo->id], 'class' =>'form-inline form-delete']) !!}
								{!! Form::hidden('id', $hojarutaarticulo->id) !!}
								{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
								{!! Form::close() !!}

		                    </td>
	                    @endif
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
	          </div> 

			  <div>
			  	<strong> <?php echo  'Mostrando ' . $hojarutaarticulos->firstItem() . ' a ' . $hojarutaarticulos->lastItem() . ' de ' . $hojarutaarticulos->total() . ' registros'; ?>	</div>
	          			{{ $hojarutaarticulos->appends(Request::only(['type', 'val']))->render() }}
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
				//$('#empleado').hide();
				$('#val').attr('type','date');
			} else
			{
				$('#val').show();
				//$('#empleado').hide();
				$('#val').attr('type','date');
			}
		}


		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
			//$('#empleados').val('').select2();
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