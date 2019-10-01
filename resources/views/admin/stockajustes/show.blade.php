@extends('adminlte::page')

@section('title', 'Gestión - Ajuste de Stock')

@section('content_header')
  <h1>
    Movimientos Realizados 
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('stockajustes.index')}}">Ajuste de Stock</a></li>
      <li class="active">Movimientos</li>
  </ol>

@stop


@section('content') 

<div class="box box-primary">
  <div class="box-header with-border box-default">   
     <form class="navbar-form navbar-center"   style="text-align: center" role="search">
        
          <div class="form-group">

            <a target="_blank" href="#" id="imprimir"> 
                <button  type="button" class="form-control btn btn btn-default"><span class="glyphicon glyphicon-list"></span> Listado</button>
            </a>
              &nbsp;&nbsp;&nbsp;
            <a href=" {{ route('stockajustes.edit', $stock->id) }}" type="button" class="btn btn btn-default">
          <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
              <span class="fa fa-step-backward">
              </span>
                Volver
            </a>
          </div>
        </form>
  </div>
    
  <div class="panel-body">
      <div class="panel-body">
          <div class="row">
      <strong><center> <h3>{{ $stock->descripcion }} </center></h3></strong>
          <hr>  
            <div class="table-responsive" >
              <table class="table table-striped table-hover tablesorter">
                <thead>
                  <tr>
                    <th><center>Fecha/Hora Ajuste</center></th>
                    <th><center>Usuario</center></th>
                    <th><center>Tipo Ajuste</center></th>
                    <th><center>Cantidad</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stockajustes as $dt)
                   
                      <tr>
                        <td><center>{{ $dt->fecha_alta }}</center></td>
                        <td><center>{{ $dt->usuario_alta }}</center></td>
                        <td><center>{{ $dt->tipoajuste->descripcion }}</center></td>
                        <td><center>{{ $dt->cantidad }}</center></td>
                      </tr>
                    @endforeach
                  
                </tbody>
              </table>
                <div> <?php echo  'Mostrando ' . $stockajustes->firstItem() . ' a ' . $stockajustes->lastItem() . ' de ' . $stockajustes->total() . ' registros'; ?> </div>
            {{ $stockajustes->render() }}
            </div>  
          </div>
      </div>
    </div>
</div>


@endsection





@push('js')
  

  <script type="text/javascript">



    $('#imprimir').on('click', function(e){
            
            var barrio = $("#barrios option:selected").attr("value")
            //alert(barrio);
            if (barrio == '')
            {
                barrio = '0';
            }

            e.preventDefault();
            window.open("{{url('detalleinformecontratoprint')}}/"+ barrio);


        });

  </script>
@endpush