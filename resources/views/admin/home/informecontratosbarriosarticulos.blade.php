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
		<strong> Generar informe por barrio y articulo </strong>
		<br>
		<br>
		 <form class="navbar-form navbar-left" role="search">
	       {{ Form::model(Request::only('barrios'), array('route' => 'detalleinformecontratos', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
			    <div class="form-group">
			      {{ form::label('buscar', 'Barrio:') }}
			      <span id="barrio" class="form-group">
						{{ Form::select('barrios', $barrios, null, ['class'=>'form-control', 'id' => 'barrios','placeholder' => 'Seleccionar...']) }}
				  </span>
			      &nbsp;
			       {{ form::label('buscar', 'Producto:') }}
			      <span id="articulo" class="form-group">
						{{ Form::select('articulos', $articulos, null, ['class'=>'form-control', 'id' => 'articulos','placeholder' => 'Seleccionar...']) }}
				  </span>
			      &nbsp;
			      <a target="_blank" href="#" id="imprimir"> 
                        <button  type="button" class="btn btn btn-primary"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                    </a>
			    </div>
		    {{ Form::close() }}
      	</form>
	</div>
		
	<div class="panel-body">
	    
</div>


@endsection





@push('js')
	

	<script type="text/javascript">

		$('#barrios').select2();
		$('#articulos').select2();


		$('#imprimir').on('click', function(e){
            
            var barrio = $("#barrios option:selected").attr("value")
            //alert(barrio);
            if (barrio == '')
            {
                barrio = '0';
                return false;
            }

            var articulo = $("#articulos option:selected").attr("value")
            //alert(barrio);
            if (articulo == '')
            {
                articulo = '0';
            }


            e.preventDefault();
            window.open("{{url('informecontratosbarriosarticulosprint')}}/"+ barrio + '/' + articulo);


        });

	</script>
@endpush