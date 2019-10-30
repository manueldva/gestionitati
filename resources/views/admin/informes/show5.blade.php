@extends('adminlte::page')

@section('title', 'Gestión - Informes')


@section('css')
	<link rel="stylesheet" href="{{ asset('css/resources/prism/prism4.css') }}">
@endsection


@section('content_header')
  <h1>
     Informe Movimientos Cliente
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
	   <strong> Ver Informe Movimientos Cliente </strong>
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
                                    {{ form::label('fechadesde', 'Fecha Desde*') }}
                                    {{ form::date('fechadesde', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechadesde']) }}
                                </td>
                                <td>
                                    &nbsp;&nbsp;
                                </td>
                                <td>
                                    {{ form::label('fechahasta', 'Fecha Hasta*') }}
                                    {{ form::date('fechahasta', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechahasta']) }}
                                </td>
                                </thead>
                            </table>
                        </div>    
                    </div>

                    <div class="form-group">
			      		{{ form::label('clientes', 'Buscador Clientes') }}
						{{ form::select('clientes', $clientes, null, ['class' => 'form-control','placeholder' => 'Buscar...'] ) }}
			      	</div>

			      	<div class="form-group">
						{{ form::label('cliente_id', 'Nro Socio *') }}
						{{ form::number('cliente_id',null, ['class' => 'form-control', 'id' => 'cliente_id']) }}
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

        $('#clientes').select2();

        $( "#clientes" ).change(function() {
			//alert($('select[name="clientes"] option:selected').val());

			if($('select[name="clientes"] option:selected').val() == '') {
				$('#cliente_id').val('');
			}else {
				$('#cliente_id').val($('select[name="clientes"] option:selected').val());
				$('#clientes').val('').select2();
				//Simula que se presiona la tecla enter 
				/*$('#cliente_id').trigger({
				    type: 'keypress',
				    which: 13
				});*/
				//$('#clientes').val('');
			}
		});
        


		$('#imprimir').on('click', function(e){
            
            var cliente_id = $("#cliente_id").val();
            var fechadesde = $("#fechadesde").val();
            var fechahasta = $("#fechahasta").val();


            if(cliente_id == '') {
                toastr.error('Debe ingresar un Nro de Socio');
      			return false;
            }

            e.preventDefault();
            window.open("{{url('informemovimientoclienteprint')}}/"+ cliente_id + "/" + fechadesde + "/" + fechahasta);


        });

		
	</script>
@endpush

           
             