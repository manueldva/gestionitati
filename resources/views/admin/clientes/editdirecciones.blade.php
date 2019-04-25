@extends('adminlte::page')

@section('title', 'Gestión - Dirección')

@section('content_header')
    <h1>
      Gestionar Dirección
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('clientes.index')}}">Clientes</a></li>
      <li class="active">Editar</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Editar Producto</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

       {!! Form::model($direccion, ['route' => ['updatedireccion', $direccion->id], 'method' => 'PUT', 'files' => true, 'id' => 'form']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

                <button id="guardar" type="button"  class="btn btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                      Guardar
                </button>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">
                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
                    <span class="fa fa-list">
                    </span>
                      Listado
                  </a>
            </div>
          </div>
        </div>
      
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12"> 
    <div class="box box-default">
      <!-- /.box-header -->
      <div class="box-body">

      <div class="col-md-6">
        <!--<div class="box box-default">-->

          <!-- /.box-header -->
          <div class="box-body">
          
            <div class="form-group">
              {{ form::label('provincia_id', 'Provincia *') }}
              {{ form::select('provincia_id', $provincias, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
            </div>
            <div class="form-group">
              {{ form::label('departamento_id', 'Departamento *') }}
              {{ form::select('departamento_id', $departamentos, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
            </div>
            <div class="form-group">
              {{ form::label('localidad_id', 'Localidad *') }}
              {{ form::select('localidad_id', $localidades, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
            </div>
            <div class="form-group">
              {{ form::label('barrio_id', 'Barrio *') }}
              {{ form::select('barrio_id', $barrios, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
            </div>
            <div class="form-group">
              {{ form::label('calle_id', 'Calle *') }}
              {{ form::select('calle_id', $calles, null, ['class' => 'form-control', 'placeholder'=> 'Seleccionar...'] ) }} 
            </div>
          </div>
          <!-- /.box-body -->
        <!--</div>-->
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4">
      <!--<div class="box box-default">-->
      
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <div class="table-responsive">
              <table class="table table-striped table-hover" data-form="Form">
                <thead>
                  <tr>
                    <td> 
                      {{ form::label('numero', 'Numero') }}
                      {{ form::number('numero', null, ['class' => 'form-control', 'id' => 'numero', 'max'=>'999999999']) }}
                    </td>
                    <td> 
                      {{ form::label('codigopostal', 'Codigo Postal') }}
                      {{ form::number('codigopostal', null, ['class' => 'form-control', 'id' => 'codigopostal', 'max'=>'999999999']) }}
                    </td>

                  </tr>
                  <tr>
                    <td> 
                      {{ form::label('manzana', 'Manzana') }}
                      {{ form::text('manzana', null, ['class' => 'form-control', 'id' => 'manzana', 'maxlength' =>'10']) }}
                    </td>
                    <td> 
                      {{ form::label('casa', 'Casa') }}
                      {{ form::text('casa', null, ['class' => 'form-control', 'id' => 'casa', 'maxlength' =>'10']) }}
                    </td>

                  </tr>
                  <tr>
                    <td> 
                      {{ form::label('edificiotorre', 'Edificio/Torre') }}
                      {{ form::text('edificiotorre', null, ['class' => 'form-control', 'id' => 'edificiotorre', 'maxlength' =>'10']) }}
                    </td>
                    <td> 
                      {{ form::label('piso', 'Piso/Dpto') }}
                      {{ form::text('piso', null, ['class' => 'form-control', 'id' => 'piso', 'maxlength' =>'10']) }}
                    </td>

                  </tr>
                  <tr>
                    <td> 
                      {{ form::label('seccion', 'Seccion') }}
                      {{ form::text('seccion', null, ['class' => 'form-control', 'id' => 'seccion', 'maxlength' =>'10']) }}
                    </td>
                    <td> 
                      {{ form::label('lote', 'Lote') }}
                      {{ form::text('lote', null, ['class' => 'form-control', 'id' => 'lote', 'maxlength' =>'10']) }}
                    </td>

                  </tr>
                  <tr>
                    <td> 
                      {{ form::label('referenciadomicilio', 'Referencia') }}
                      {{ form::textarea('referenciadomicilio', null, ['class' => 'form-control', 'id'=>'referenciadomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
                    </td>
                    <td> 
                      {{ form::label('observaciondomicilio', 'Observacion') }}
                      {{ form::textarea('observaciondomicilio', null, ['class' => 'form-control', 'id'=>'observaciondomicilio', 'rows' => 5, 'cols' => 40, 'maxlength' =>'500']) }}
                    </td>

                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-10">
        <div class="box-body">
            <div class="box-header with-border">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Datos del Vendedor</h3>
            </div>
            <div class="form-group">
          <div class="table-responsive">
            <table class="table table-striped table-hover" data-form="Form">
              <thead>
                <tr>
                  <td class="col-md-3"> 
                    {{ form::label('empleado_id', 'Cod. *') }}
                    {{ form::number('empleado_id', null, ['class' => 'form-control', 'id' => 'empleado_id', 'max'=>'999999999']) }}
                  </td>
                  <td> 
                    {{ form::label('empleado', 'vendedor') }}
                   {{ form::select('empleado',$empleados,  null, ['class' => 'form-control inline-search', 'id' => 'empleado','placeholder' => 'Seleccionar...'] ) }}
                  </td>
                  <td> 
                    {{ form::label('horariovisita', 'visita') }}
                    {{ form::select('horariovisita', ['1' => 'Mañana', '2' => 'Tarde', '3' => 'Noche' ],  null, ['class' => 'form-control', 'id' => 'horariovisita','placeholder' => 'Seleccionar...'] ) }}
                  </td>
                  <td> 
                    {{ form::label('horadesde', 'Desde') }}
                    {{ form::time('horadesde', null, ['class' => 'form-control', 'id' => 'horadesde']) }}
                  </td>
                   <td> 
                    {{ form::label('horahasta', 'Hasta') }}
                    {{ form::time('horahasta', null, ['class' => 'form-control', 'id' => 'horahasta']) }}
                  </td>

                </tr> 
              </thead>
            </table>
          </div>
         
        </div>
      </div>


    </div>
      <!-- /.box-body -->
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>

{!! Form::close() !!}


@endsection


@push('js')
  <!-- todo lo que tenga que realizar un ajax -->
  <script type="text/javascript">

    $('#provincia_id').select2();
    $('#departamento_id').select2();
    $('#localidad_id').select2();
    $('#barrio_id').select2();
    $('#calle_id').select2();

    /*buscar empleado desde codigo*/
    function buscarEmpleado() {

      var empleado_id = $('#empleado_id').val();

      if (empleado_id == '') empleado_id = $('#empleado').val();

      if (empleado_id !== '') {
        $.ajax({
          dataType: 'json',
          url: APP_URL + '/api/buscarempleado',
          //url: '../api/validardocumento',
          data: {q: empleado_id}
        }).done(function(data) {
          //var $empleado = $('#empleado'); 
          if(data !== 0) {
            $("#empleado_id").val(data.id);
            $("#patente").val(data.patente);
            $("#movil").val(data.movil);
            $("#empleado").val(data.id);
            //$("#patente").text(data.patente);


            //$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
            //toastr.info('Codigo de vendedor correcto');
          } else{
            $("#empleado_id").val('');
            $("#patente").val('');
            $("#movil").val('');
            $("#empleado").val('');

            
          }
          
        });
      } else {
        $("#empleado_id").val('');
        $("#patente").val('');
        $("#movil").val('');
        $("#empleado").val('');
      }
    }

    buscarEmpleado();

    

    $('#empleado_id').focusout(function(e) {
      if ($('#empleado_id').val() == '') $('#empleado').val(''); 
      buscarEmpleado();

    });

    $(document).ready(function(){
    $("#empleado_id").keypress(function(e) {
        //no recuerdo la fuente pero lo recomiendan para
        //mayor compatibilidad entre navegadores.
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
          if ($('#empleado_id').val() == '') $('#empleado').val(''); 
          buscarEmpleado();

        }
      });
    });

    $('#empleado').on('change', function(e){
      if ($('#empleado').val() !== '') $('#empleado_id').val(''); 
      buscarEmpleado();
    });


    /*para combos de domicilio*/
    $('#provincia_id').on('change', function(e){
        console.log(e);
        var provincia_id = e.target.value;

        $.get('{{ url("/") }}/api/departamentos?provincia_id=' + provincia_id,function(data) {

          $('#departamento_id').empty();
          $('#departamento_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
        $('#localidad_id').empty();
          $('#localidad_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
        $('#barrio_id').empty();
          $('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
        $('#calle_id').empty();
        $('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

          $.each(data, function(fetch, departamento){
            console.log(data);
            $('#departamento_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
          })
        });
        /*id2 = $("#provincia_id option:selected").val();
        cargar_departamentos(id2);*/
    });

    $('#departamento_id').on('change', function(e){
        console.log(e);
        var departamento_id = e.target.value;

        $('#localidad_id').empty();
        $('#localidad_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
      $('#barrio_id').empty();
      $('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
      $('#calle_id').empty();
      $('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

      //barrio
        $.get('{{ url("/") }}/api/localidadescli?departamento_id=' + departamento_id,function(data) {
          $.each(data, function(fetch, departamento){
            console.log(data);
            $('#localidad_id').append('<option value="'+ departamento.id +'">'+ departamento.descripcion +'</option>');
          })
        });
    });


    $('#localidad_id').on('change', function(e){
        console.log(e);
        var localidad_id = e.target.value;

        if (localidad_id !== '') {
        $.ajax({
          dataType: 'json',
          url: APP_URL + '/api/validarsinbarrio',
          //url: '../api/validardocumento',
          data: {q: localidad_id}
        }).done(function(data) {
          //var $empleado = $('#empleado'); 
          if(data == 0) {
            $('#sinbarrio').val(0);
          } else{
            $('#sinbarrio').val(1);       
          }
          
        });
      } else {
        $('#sinbarrio').val(0);
      }
      //alert($('#sinbarrio').val());   
      $('#barrio_id').empty();
      $('#barrio_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');
      $('#calle_id').empty();
      $('#calle_id').append('<option value="" disable="true" selected="true">Seleccionar...</option>');

      //barrio
        $.get('{{ url("/") }}/api/barrios?localidad_id=' + localidad_id,function(data) {
          $.each(data, function(fetch, barrio){
            console.log(data);
            $('#barrio_id').append('<option value="'+ barrio.id +'">'+ barrio.descripcion +'</option>');
          })
        });

      //calle
      $.get('{{ url("/") }}/api/calles?localidad_id=' + localidad_id,function(data) {
        $.each(data, function(fetch, calle){
        console.log(data);
        $('#calle_id').append('<option value="'+ calle.id +'">'+ calle.descripcion +'</option>');
        })
      });
        /*id2 = $("#provincia_id option:selected").val();
        cargar_departamentos(id2);*/
    });


    $('#barrio_id').on('change', function(e){
        console.log(e);
        var barrio_id = e.target.value;

        if (barrio_id !== '') {
        $.ajax({
          dataType: 'json',
          url: APP_URL + '/api/validarsincalle',
          //url: '../api/validardocumento',
          data: {q: barrio_id}
        }).done(function(data) {
          //var $empleado = $('#empleado'); 
          if(data == 0) {
            $('#sincalle').val(0);
          } else{
            $('#sincalle').val(1);        
          }
          
        });
      } else {
        $('#sincalle').val(0);
      }
      //alert($('#sincalle').val());    
      
    });


    $( "#guardar" ).click(function() {


       
          $('#form').submit();



    });

    

  
  </script>


@endpush