@extends('adminlte::page')

@section('title', 'Gestión - Informes')


@section('css')
	<link rel="stylesheet" href="{{ asset('css/resources/prism/prism4.css') }}">
@endsection


@section('content_header')
  <h1>
     Informe  Vendedores Stock
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('informes.index')}}">Informes Generales</a></li>
    <li class="active">Ver</li>
  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Ver Informe Vendedores Stock </strong>
	</div>
		
	<div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row col-md-12">
                    <div class="form-group pull-right">
                        <a href="{{ route('informes.index') }}" type="button" class="btn btn btn-default">
                            <span class="fa fa-list">
                            </span>
                                Listado
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::open() !!}
                    <div class="form-group">
                        <div class="table-responsive" >
                            <table class="table table-striped table-hover tablesorter">
                                <thead>
                                <td>
                                    {{ form::label('fecha', 'Fecha*') }}
                                    {{ form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
                                </td>
                                
                                </thead>
                            </table>
                        </div>    
                    </div>

                    <div class="form-group">
                        {{ form::label('usuario', 'Vendedor *') }}
                        {{ form::select('usuario', $usuarios,  null, ['class' => 'form-control','placeholder' => 'Seleccionar'] ) }}
                    </div>


                    <br>
                    <!--<a  type="submit"  class="btn btn btn-primary" target="_blank">
                        Generar Informe
                    </a>-->
                    
                
                    <a target="_blank" href="#" id="imprimir"> 
                        <button  type="button" class="btn btn btn-primary">  Generar Informe</button>
                    </a>
                {!! Form::close() !!}

            </div>
        </div>
	</div>
</div>

@endsection





@push('js')


	<script type="text/javascript">

		$('#imprimir').on('click', function(e){
            
            var usuario = $("#usuario option:selected").attr("value")
            //alert(usuario);
            if (usuario == '')
            {
                usuario = 'Todos';
            }

            if(usuario == 'Todos') {
                toastr.error('Debe seleccionar un vendedor para generar el informe');
      			return false;
            }
            var fechadesde = $("#fecha").val();
            //var fechahasta = $("#fechahasta").val();
            e.preventDefault();
            window.open("{{url('informevendedorstockprint')}}/"+ usuario + "/" + fechadesde);


        });

		
	</script>
@endpush

           
             