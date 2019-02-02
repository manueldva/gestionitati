@extends('adminlte::page')

@section('title', 'Gestión - Barrios')

@section('content_header')
    <h1>
      Gestionar Barrios
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('barrios.index')}}">Barrios</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nuevo Barrio</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'barrios.store', 'id' => 'form']) !!}
      <input type="hidden" name="listado_barrios" id="id_lista_barrios">

      <div class="col-md-12">
        <div class="row col-md-12">
          <div class="form-group pull-right">
                <button  id="guardar"  type="button" class="btn btn btn-primary">
                  <span class="glyphicon glyphicon-floppy-disk">
                  </span>
                    Guardar
                </button>

                <a href="{{ route('barrios.index') }}" type="button" class="btn btn btn-default">
                  <span class="fa fa-list">
                  </span>
                    Listado
                </a>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {{ form::label('provincia_id', 'Provincia *') }}
          {{ form::select('provincia_id', $provincias,  null, ['class' => 'form-control', 'id' => 'provincia_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('departamento_id', 'Departamento *') }}
          {{ form::select('departamento_id', [],  null, ['class' => 'form-control', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          {{ form::label('localidad_id', 'Localidad *') }}
          {{ form::select('localidad_id', [],  null, ['class' => 'form-control', 'id' => 'localidad_id','placeholder' => 'Seleccionar...'] ) }}
        </div>

        <div class="form-group">
          <div class="table-responsive">
            <table class="table table-striped table-hover" data-form="Form">
              <thead>
                <tr>
                  <td> 
                    {{ form::label('nombredescripcion', 'descripcion') }}
                    {{ form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) }}
                  </td>
                  <td> 
                    <br>
                    <a type="button" id="agregarbarrio" name="agregarbarrio" class="btn btn btn-success">
                                <span class="fa fa-plus-circle">
                                </span>
                                AGREGAR
                            </a>
                  </td>
                </tr>		
              </thead>
            </table>
          </div>
          <div class="form-group">
            <div class="table-responsive">
              <table   id="table_barrios" class="table table-striped table-hover" data-form="Form">
                <thead>
                  <tr>
                  <!--<th width="10px"> ID</th>-->
                    <th style="display:none;"> Codigo</th>
                    <th style="display:none;"> Codigo</th>
                    <th style="display:none;"> Codigo</th>
                    <th> Descripción Barrio</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>
               
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection




@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">
		
    var APP_RL = "{{ url('/') }}";
    
    
    /*para combos de domicilio*/
		$('#provincia_id').on('change', function(e){
		    console.log(e);
		    var provincia_id = e.target.value;

		    $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

		      $('#departamento_id').empty();
		      $('#departamento_id').append('<option value="0" disable="true" selected="true">Seleccionar...</option>');


		      $.each(data, function(fetch, departamento){
		        console.log(data);
		        $('#departamento_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
		      })
		    });
		    /*id2 = $("#provincia_id option:selected").val();
		    cargar_departamentos(id2);*/
		});

    
    $(document).ready(function(){
		    $("#descripcion").keypress(function(e) {
		        //no recuerdo la fuente pero lo recomiendan para
		        //mayor compatibilidad entre navegadores.
		        var code = (e.keyCode ? e.keyCode : e.which);
		        if(code==13){
              $('#agregarbarrio').click();  
              return  false;
		        }
		    });
    });
    


		/*para agregar departamento al listado*/
		$( "#agregarbarrio" ).click(function(e) {

			/*validaciones*/ 
			if($("#descripcion").val() == '' || $("#provincia_id").val() == '' || $("#departamento_id").val() == '' || $("#localidad_id").val() == '') {
				swal({
					title: 'No se puede agregar este barrio',
					text: 'faltan algunos datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});
				return false;
			} 
			/**/
			
			//variables para guardar en la grilla
			var descripcion = $("#descripcion").val();
      var provincia_id = $("#provincia_id").val();
      var departamento_id = $("#departamento_id").val();
      var localidad_id = $("#localidad_id").val();
      var existe = 0;
      
      $('#table_barrios tr').each(function(index, element) {
          localidadidtemp = $(element).find("td").eq(2).text();
			    descripciontemp = $(element).find("td").eq(3).text();

			    if(departamentoidtemp == localidad_id && descripcion == descripciontemp)
			    {
            existe = 1;
            toastr.error('Barrio ya existente dentro de la lista');
           
			    }
			

      });

      //verificar si ya existe el registro en la base de datos
      $.ajax({
        dataType: 'json',
        url: APP_URL + '/api/verificarbarrio',
        async: false,
        //url: '../api/validardocumento',
        data: {d: descripcion, l:localidad_id},
        
      }).done(function(data) {

        if(data !== 0) {
          existe = 1;
          toastr.error('Barrio ya existente en la base de datos');
        } 
      });

      //modificar por esto

      // https://stackoverflow.com/questions/1457690/jquery-ajax-success-anonymous-function-scope

      if(existe == 0) {
        //cargo la grilla
        $('#table_barrios tbody').prepend(
          '<tr>' + 
          '<td style="display:none;">' + provincia_id + '</td>' +
          '<td style="display:none;">' + departamento_id + '</td>' +
          '<td style="display:none;">' + localidad_id + '</td>' +
          '<td>' + descripcion + '</td>' +
          "<td><a class='delete btn btn-sm btn-danger' onclick ='deletefamiliar_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
          '</td>' +
          '</tr>');

        $("#descripcion").val('');
        //var provincia_id = $("#provincia_id").val('');


        toastr.success('Barrio agregado a la lista');
        
      }
			

		});


		/*borrar filas del listado de familiares*/
		function deletefamiliar_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Barrio eliminado de la lista');
		}




		$("#guardar").click(function() {
      //$('#form').submit();

      var listado = crear_listado_barrios();
      $('#id_lista_barrios').val(listado);

      if ($('#id_lista_barrios').val() == '')
      {
        swal({
					title: 'Debe ingresar por lo menos 1 barrio',
					text: 'faltan datos',
					type: 'error',
					//confirmButtonColor: '#DD6B55',
					confirmButtonText: 'OK',
					closeOnConfirm: false
				});
        return false;
      } else {
        $('#form').submit();  
      }


       
    });
    
    function crear_listado_barrios() {
      var listado = '';
      var provincia_id, departamento_id, descripcion;

      $("#id_lista_barrios").val('');

      $('#table_barrios tbody tr').each(function () {	 
        provincia_id = $(this).find("td").eq(0).html();
        departamento_id = $(this).find("td").eq(1).html();
        localidad_id = $(this).find("td").eq(2).html();
        descripcion = $(this).find("td").eq(3).html();

        listado += provincia_id + "|" + departamento_id + "|" + localidad_id + "|" + descripcion + "&&&";
      });

      return listado;
    }



	</script>

@endpush