@extends('adminlte::page')

@section('title', 'Gestión - Localidades')

@section('content_header')
    <h1>
      Gestionar Localidades
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('localidades.index')}}">Localidades</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div id="create" class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Nueva Localidad</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

			{!! Form::open(['route' => 'localidades.store', 'id' => 'form']) !!}
      <input type="hidden" name="listado_localidades" id="id_lista_localidades">

      <div class="col-md-12">
        <div class="row col-md-12">
          <div class="form-group pull-right">
                <button  id="guardar"  type="button" class="btn btn btn-primary">
                  <span class="glyphicon glyphicon-floppy-disk">
                  </span>
                    Guardar
                </button>

                <a href="{{ route('localidades.index') }}" type="button" class="btn btn btn-default">
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
          {{ form::label('departamento_id', 'Provincia *') }}
          {{ form::select('departamento_id', $departamentos,  null, ['class' => 'form-control', 'id' => 'departamento_id','placeholder' => 'Seleccionar...'] ) }}
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
                    <a type="button" id="agregarlocalidad" name="agregarlocalidad" class="btn btn btn-success">
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
              <table   id="table_localidades" class="table table-striped table-hover" data-form="Form">
                <thead>
                  <tr>
                  <!--<th width="10px"> ID</th>-->
                    <th style="display:none;"> Codigo</th>
                    <th style="display:none;"> Codigo</th>
                    <th> Descripción Localidad</th>
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
              $('#agregarlocalidad').click();  
              return  false;
		        }
		    });
    });
    


		/*para agregar departamento al listado*/
		$( "#agregarlocalidad" ).click(function(e) {

			/*validaciones*/ 
			if($("#descripcion").val() == '' || $("#provincia_id").val() == '' || $("#departamento_id").val() == '') {
				swal({
					title: 'No se puede agregar esta localidad',
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
      var existe = 0;
      
      $('#table_localidades tr').each(function(index, element) {
          departamentoidtemp = $(element).find("td").eq(0).text();
			    descripciontemp = $(element).find("td").eq(1).text();

			    if(departamentoidtemp == departamento_id && descripcion == descripciontemp)
			    {
            existe = 1;
            toastr.error('Localidad ya existente dentro de la lista');
           
			    }
			

      });

      //verificar si ya existe el registro en la base de datos
      $.ajax({
        dataType: 'json',
        url: APP_URL + '/api/verificarlocalidad',
        async: false,
        //url: '../api/validardocumento',
        data: {d: descripcion, di:departamento_id},
        
      }).done(function(data) {

        if(data !== 0) {
          existe = 1;
          toastr.error('Localidad ya existente en la base de datos');
        } 
      });

      //modificar por esto

      // https://stackoverflow.com/questions/1457690/jquery-ajax-success-anonymous-function-scope

      if(existe == 0) {
        //cargo la grilla
        $('#table_localidades tbody').prepend(
          '<tr>' + 
          '<td style="display:none;">' + provincia_id + '</td>' +
          '<td style="display:none;">' + departamento_id + '</td>' +
          '<td>' + descripcion + '</td>' +
          "<td><a class='delete btn btn-sm btn-danger' onclick ='deletefamiliar_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
          '</td>' +
          '</tr>');

        $("#descripcion").val('');
        //var provincia_id = $("#provincia_id").val('');


        toastr.success('Localidad agregada a la lista');
        
      }
			

		});


		/*borrar filas del listado de familiares*/
		function deletefamiliar_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Localidad eliminada de la lista');
		}




		$("#guardar").click(function() {
      //$('#form').submit();

      var listado = crear_listado_localidades();
      $('#id_lista_localidades').val(listado);

      if ($('#id_lista_localidades').val() == '')
      {
        swal({
					title: 'Debe ingresar por lo menos 1 localidad',
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
    
    function crear_listado_localidades() {
      var listado = '';
      var provincia_id, departamento_id, descripcion;

      $("#id_lista_localidades").val('');

      $('#table_localidades tbody tr').each(function () {	 
        provincia_id = $(this).find("td").eq(0).html();
        departamento_id = $(this).find("td").eq(1).html();
        descripcion = $(this).find("td").eq(2).html();

        listado += provincia_id + "|" + departamento_id + "|" + descripcion + "&&&";
      });

      return listado;
    }



	</script>

@endpush