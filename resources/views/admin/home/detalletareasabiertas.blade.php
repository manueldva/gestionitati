@extends('adminlte::page')

@section('title', 'Gestión - Informe')

@section('content_header')
  <h1>
    Informe 
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('home')}}">Tablero</a></li>
  </ol>

@stop


@section('content')	

<div class="box box-primary">
	<div class="box-header with-border box-default">
		@if( $miusuario == 0)
		 	<strong> Listado de otras tareas abiertas </strong>
		@else	 
			<strong> Listado de mis tareas abiertas </strong>
		@endif
	</div>
		
	<div class="panel-body">
	    <div class="panel-body">
	        <div class="row">
	          <div class="table-responsive" >
	            <table class="table table-striped table-hover tablesorter">
	              <thead>
	                <tr>
	                  <!--<th width="10px"> ID</th>-->
	                  <th> Nro Tarea</th>
										@if( $miusuario == 0)
											<th>Asignado</th>
										@endif
										<th> Titulo</th>
	                  <th> Motivo</th>
                      <th> Servidor</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($tareas as $tarea)
	                  <tr>
	                    <td>{{ $tarea->id }}</td>
											@if( $miusuario == 0)
												<td>{{ $tarea->usuario_alta }}</td>
											@endif
											<td>{{ $tarea->titulotarea }}</td>
	                    <td>{{ $tarea->motivo->descripcion }}</td>
                      <td>{{ $tarea->servidor->descripcion }}</td>
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
                {{ $tareas->links() }}
                
	          </div>  
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	

	<script type="text/javascript">

		
	</script>
@endpush