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
		<strong> Cantidad de articulos registrados en los contratos </strong>
		 <form class="navbar-form navbar-right" role="search">
	       {{ Form::model(Request::only('barrios'), array('route' => 'detalleinformecontratos', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Barrio:') }}
			      <span id="barrio" class="form-group">
						{{ Form::select('barrios', $barrios, null, ['class'=>'form-control', 'id' => 'barrios','placeholder' => 'Seleccionar...']) }}
				  </span>
				   &nbsp;
			      <button type="submit" class="form-control btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
			      
			    </div>
		    {{ Form::close() }}
      	</form>
	</div>
		
	<div class="panel-body">
	    <div class="panel-body">
	        <div class="row">
			<strong> <h3>Contratos Registrados: {{ $contratos }} </h3></strong>
	        <hr>	
	          <div class="table-responsive" >
	            <table class="table table-striped table-hover tablesorter">
	              <thead>
	                <tr>
	                  <th> Cod. Articulo</th>
	                  <th> Articulo</th>
					  <th> Cantidad</th>
	                </tr>
	              </thead>
	              <tbody>
	                @foreach ($data as $dt)
	                  <tr>
	                  	<td>{{ $dt['codigo'] }}</td>
	                    <td>{{ $dt['articulo'] }}</td>
						<td>{{ $dt['cantidad'] }}</td>
	                  </tr>
	                @endforeach
	              </tbody>
	            </table>
                
	          </div>  
	        </div>
	    </div>
    </div>
</div>


@endsection





@push('js')
	

	<script type="text/javascript">

		$('#barrios').select2();

	</script>
@endpush