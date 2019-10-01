@extends('adminlte::page')

@section('title', 'Gestión - Empleados')
  
@section('css')
 
@endsection

@section('content_header')
    <h1>
      Gestionar Empleados
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('empleados.index')}}">Empleados</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Tansferir Contratos</strong>
  </div>
    
  <div class="panel-body">
    <div class="row">

  {!! Form::open(['route' => 'empleadotransferirstore','files' => true, 'id' => 'form']) !!}
  
        <div class="col-md-12" >
          <div class="row col-md-12">
            <div class="form-group" style="text-align: center">

                <button id="guardar" type="button" class="btn btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                      Guardar
                </button>
                

                <a href="{{ route('empleados.index') }}" type="button" class="btn btn btn-default">
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
      <div class="box-header with-border">


        <h3 class="box-title">
          
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

            <div class="form-group">
            <div class="table-responsive">
              <table class="table table-striped table-hover" data-form="Form">
                <thead>
                  <tr>  
                    <td> 
                      {{ form::label('empleadodesde_id', 'Empleado:') }}
                      {{ form::select('empleadodesde_id',  $empleadodesde, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }} 
                    </td>
                    <td>
                      {{ form::label('empleadoatransferir_id', 'Cambiar a:') }}
                      {{ form::select('empleadoatransferir_id',  $empleadoatransferir, null, ['class' => 'form-control'] ) }} 
                    </td>
                  </tr>

                </thead>
              </table>
            </div>
          </div>
          </div>

      

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
  <!-- /.col -->
<!--      segundo div general                              -->


{!! Form::close() !!}


@endsection


@push('js')

  <script type="text/javascript">
    
    $( "#guardar" ).click(function() {



      if ($('#empleadodesde_id').val() == ''){
        toastr.error('Debe seleccionar un empleado para hacer la transferencia');
        return false;
      } else {

        swal({ 
          title: "El cambio que esta por realizar es permanente",
          text: "¿Esta seguro de querer realizarlo?",
          type: "warning",
          showCancelButton: true,
          dangerMode: true,
          confirmButtonColor: "#11C66C",
          confirmButtonText: "Si",
          cancelButtonText: "No", 
          closeOnConfirm: false,
          closeOnCancel: false },

          function(isConfirm){ 
          if (isConfirm) {
            $('#form').submit();
            //toastr.error('guardar');
          } else { 
            swal({ 
              title: "El cambio fue descartado",
             // text: "¿Esta seguro de querer realizarlo?",
              type: "success",
              closeOnConfirm: true
            })
          } 
        });

      }

     
    });
  </script>
@endpush