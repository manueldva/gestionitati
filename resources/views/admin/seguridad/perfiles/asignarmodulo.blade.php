@extends('adminlte::page')

@section('title', 'Gestion - Perfiles')

@section('content_header')
    <h1>
      Asignar Modulos
      <!--<small>Listado</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('perfiles.index')}}">Perfiles</a></li>
      <li class="active">Nuevo</li>
    </ol>

@stop


@section('content')

<div class="box box-primary">
  <div class="box-header with-border box-default">
    <strong>Asignar Modulos</strong>
  </div>
    
  <div class="panel-body">
	<div class="row">
				<div class="col-md-12">
					<!-- FIN DE AVISOS -->		
					<form action="{{ asset('guardarpermisos/') . '/' . $perfil->id }}" method="POST" role="form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="portlet">
							<div class="portlet-body form">
								<div class="form-body">
									<div class="actions" align="right">
										<button type="submit" class="btn btn-primary">
											<i class="glyphicon glyphicon-floppy-disk"></i>
											<span class="hidden-480">
												Guardar 
											</span>
										</button>
										
										<a href="{{ asset('perfiles') }}" class="btn default green">	
											<button type="button" class="btn btn-default">
												<i class="fa fa-list"></i>
												<span class="hidden-480">
												Listado 
											</span>
											</button> 
										</a>
									</div>
									<!-- ELIMINAR LA CLASE HAS-ERROR PARA EL CASO NORMAL -->
									<div class="col-md-6">
										<div class="form-group">
											<label for="perfil" class="control-label"> Perfil </label>
											<input name="perfil" id="perfil" type="text" class="form-control" value="{{$perfil->perfil}}" readonly>
										</div>

										<table id="table_modulos" class="table table-striped table-bordered table-advance table-hover">
										<thead>
											<tr>
												<th class="hidden-xs" colspan="2">
										<center>
							                <label>El perfil tiene permiso a: NTP (No Tiene Permiso), SL (Solo Lectura), CT (Control Total).</label>
            							</center>
            									</th>
            								</tr>
            							</thead>
            								<tr>
												
												<th>

		            							<?php

		            							$cantidad = 0;
		            							foreach ($modulos as $modulo):

		            								$tipo_permiso = 0;

		            								foreach ($modulos_permisos as $permiso)
		            								{
		            									if ($permiso->pivot->modulo_id == $modulo->id)
		            									{
		            										$tipo_permiso = $permiso->pivot->permiso;
		            										break;
		            									}
		            								}

		            								$cantidad++;
		            								if ($cantidad == 10 || $cantidad == 19 || $cantidad == 28):
		            								?>

		            							        </th>
		            							        <th>

		            							    <?php endif; ?>

													<div class="form-group">
										                <label class="radio-inline">
										                    <input type="radio" name="{{$modulo->id}}" id="{{$modulo->id}}" value="0" <?php if ($tipo_permiso == 0) echo 'CHECKED' ?>>&nbsp;&nbsp;NTP
										                </label>
										                <label class="radio-inline">
										                    <input type="radio" name="{{$modulo->id}}" id="{{$modulo->id}}" value="1" <?php if ($tipo_permiso == 1) echo 'CHECKED' ?>>&nbsp;&nbsp;SL
										                </label>
										                <label class="radio-inline">
										                    <input type="radio" name="{{$modulo->id}}" id="{{$modulo->id}}" value="2" <?php if ($tipo_permiso == 2) echo 'CHECKED' ?>>&nbsp;&nbsp;CT
										                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                <label> {{ $modulo->descripcion }}</label>
			            							</div>

		            							<?php
		            							endforeach;
		            							?>


            									</th>

            								</tr>
            							</table>
										<br>
										<br>
										<br>
									</div>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>


@endsection