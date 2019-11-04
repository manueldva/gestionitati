@extends('adminlte::page')

@section('title', 'Gestión - Informes Generales')

@section('content_header')
  <h1>
    Gestionar Informes Generales
    <!--<small>Listado</small>-->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('informes.index')}}" class="active">Informes Generales</a></li>

  </ol>


@stop
@section('content')

<div class="box box-primary">
	<div class="box-header with-border box-default">
	   <strong> Informes Generales </strong>
	</div>
		
	<div class="panel-body">
	    <div class="row">

            <div class="col-md-6">
                <br>
                <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 1) }}" style="color:#235B88;">
						Informes vendedores Hoja De Ruta
					</a>
                </div>
                <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 3) }}" style="color:#235B88;">
						Informes vendedores Stock
					</a>
                </div> 
               
                <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 2) }}" style="color:#235B88;">
						Informes ventas en oficina
					</a>
                </div> 

               
                 <!--
                <div class="form-group">
                    {{ link_to('/manualusuario/Empleado.pdf', 'Empleado', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Proveedores.pdf', 'Proveedores', ['target' => '_blank']) }} 
                </div> 

                 <div class="form-group">
                    {{ link_to('/manualusuario/Clientes.pdf', 'Clientes', ['target' => '_blank']) }} 
                </div> 

                 <div class="form-group">
                    {{ link_to('/manualusuario/Articulos.pdf', 'Gestión de Articulos', ['target' => '_blank']) }} 
                </div> 

                 <div class="form-group">
                    {{ link_to('/manualusuario/Remitos.pdf', 'Remitos Internos', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Compras.pdf', 'Compras', ['target' => '_blank']) }} 
                </div> 
                -->
            </div>

            <div class="col-md-6">
                <br>
                <!--
                <div class="form-group" style="font-size:16pt">
                    <a target="_blank" href="{{ route('informes.show', 4) }}" style="color:#235B88;">
                        Informe Clientes Sin Comprar por un Mes
                    </a>
                </div> 
                -->
                 <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 4) }}" style="color:#235B88;">
                        Informe Clientes Sin Comprar por Mes
                    </a>
                </div> 
                <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 5) }}" style="color:#235B88;">
                        Informe Movimientos del Cliente
                    </a>
                </div> 
                 <div class="form-group" style="font-size:16pt">
                    <a href="{{ route('informes.show', 6) }}" style="color:#235B88;">
                        Informe Movimientos Stock Venta
                    </a>
                </div> 

                <!--

                <div class="form-group">
                    {{ link_to('/manualusuario/Ventas.pdf', 'Ventas', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Caja.pdf', 'Caja', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Cuentacorriente.pdf', 'Cuent Corriente', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Stock.pdf', 'Stock', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Complementos.pdf', 'Complementos', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Seguridad.pdf', 'Seguridad', ['target' => '_blank']) }} 
                </div> 

                <div class="form-group">
                    {{ link_to('/manualusuario/Taller.pdf', 'Taller', ['target' => '_blank']) }} 
                </div> 
               --> 
            </div>

        </div>
	</div>
</div>

@endsection