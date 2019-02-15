
<input type="hidden" name="listado_articulos" id="id_lista_articulos">
<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-user"></i>

	      <h3 class="box-title"><strong>Cliente: {{ $cliente->apellido }} {{ $cliente->nombre }}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Nro. Documento: {{ $cliente->numerodocumento }} </strong></h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Ingresar los datos del contrato:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			      <div class="form-group">
			      	{{ form::label('fechacontrato', 'Fecha Contrato') }}
					{{ form::date('fechacontrato', null, ['class' => 'form-control', 'id' => 'fechacontrato']) }}
					<div id="fechacontratospan" class="form-group has-error" style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
			      </div>
			      
			      <div class="form-group">
					{{ form::label('clientedireccion_id', 'Dirección *') }}
					{{ form::select('clientedireccion_id',  $direcciones, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
					<div id="direccion_idspan" class="form-group has-error" style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
				  </div>

				   <div class="form-group">
					{{ form::label('modelocontrato_id', 'Tipo de Contrato *') }}
					{{ form::select('modelocontrato_id',  $modelocontratos, null, ['class' => 'form-control' ,'placeholder' => 'Seleccionar...'] ) }} 
					<div id="modelocontrato_idspan" class="form-group has-error" style="display: none">
						<span class="help-block">Campo Obligatorio</span>
					</div>
				  </div>
			      
			    </div>
			    <!-- /.box-body -->
			  <!--</div>-->
			  <!-- /.box -->
			</div>
			<!-- /.col -->

			<div class="col-md-6 pull-right">
			  <!--<div class="box box-default">-->
			    
			    <div class="box-header with-border">
			      

			      <h3 class="box-title">Articulos en posesión del cliente:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
					
					<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>	
									<td class="col-md-3"> 
										{{ form::label('articulo_id', 'Cod.') }}
										{{ form::number('articulo_id', null, ['class' => 'form-control', 'id' => 'articulo_id']) }}
									</td>
									<td>
										{{ form::label('articulo', 'Articulo') }}
										<br>
										{{ form::select('articulo', $articulos,  null, ['class' => 'form-control inline-search', 'id' => 'articulo','placeholder' => 'Seleccionar...'] ) }}
									</td>
								</tr>

								<tr>
									<td> 
										{{ form::label('cantidadarticulo', 'Cantidad') }}
										{{ form::number('cantidadarticulo', null, ['class' => 'form-control', 'id' => 'cantidadarticulo']) }}
									</td>
									<td> 
										<br>
										<a type="button" id="agregararticulo" name="agregararticulo" class="btn btn btn-success">
						                <!--<a href="{{ route('clientes.index') }}" type="button" class="btn btn btn-default">-->
						                    <span class="fa fa-plus-circle">
						                    </span>
						                      AGREGAR
						                  </a>
									</td>
								</tr>	
								
							</thead>
						</table>
						<div class="form-group">
							<div class="table-responsive">
								<table   id="table_articulos" class="table table-striped table-hover" data-form="Form">
									<thead>
										<tr>
										<!--<th width="10px"> ID</th>-->
											<th style="display:none;"> Codigo</th>
											<th> Articulo</th>
											<th> Cantidad</th>
											<th> </th>
										</tr>
									</thead>
									<tbody>
										@isset($contratoarticulos)
											@foreach ($contratoarticulos as $contratoarticulo)
							                  <tr>
							                    <td style="display:none;">{{ $contratoarticulo->articulo_id }}</td>
							                    <td>{{ $contratoarticulo->articulo->descripcion }}</td>
												<td>{{ $contratoarticulo->cantidad }}</td>
							                   
								                    <td>
									                   <a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'>
									                   	<span class='glyphicon glyphicon-trash'></span>
									                   </a>
								               	    </td>
							                   
							                  </tr>
							                @endforeach
										@endif
									</tbody>
								</table>
								<div id="table_articulosspan" class="form-group has-error" style="display: none">
									<span class="help-block">Debe haber al menos un registro en la lista</span>
								</div>
							</div>
						</div>
					</div>
				  </div>

			    </div>
			    <!-- /.box-body -->
			</div>

	 	</div>
	    <!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

<!--      segundo div general                              -->

<div class="col-md-12">
	  <div class="box box-default">
	  	<div class="box-header with-border">
	      <i class="fa fa-file"></i>

	      <h3 class="box-title">Lista de Contratos</h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">

			<div class="form-group">
				
				<div class="form-group">
					<div class="table-responsive">
						<table   id="table_familiares" class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
								<!--<th width="10px"> ID</th>-->
								
									<th> <center>Nro Cliente</center></th>
									<th> <center>Fecha Contrato</center></th>
									<th> <center>Modelo Contrato</center></th>
									<th> <center>Articulos</center></th>
								</tr>
							</thead>
							<tbody>
								@isset($contratos)
									@foreach ($contratos as $contrato)
					                  <tr>
					                    
					                    <td><center>{{ $cliente->id }}</center></td>
										<td><center>{{ \Carbon\Carbon::parse($contrato->fechacontrato)->format('d/m/Y') }}</center></td>
										<td><center>{{ $contrato->modelocontrato->descripcion }}</center></td>
										<td><center>{{ $contrato->usuario_modi }}</center></td>
					                    
					                  </tr>
					                @endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
	    </div>
	  </div>
	</div>
	
</div>
	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		var APP_RL = "{{ url('/') }}";


		//buscador articulos
		function buscarArticulos(articulo_id) {

			//alert(articulo_id);

			if (articulo_id !== '') {
			$.ajax({
				dataType: 'json',
				url: APP_URL + '/api/articulos',
				//url: '../api/validardocumento',
				data: {q: articulo_id}
			}).done(function(data) {
				//var $empleado = $('#empleado'); 
				if(data !== 0) {
					$("#articulo_id").val(data.id);
					$("#articulo").val(data.id);
					$("#cantidadarticulo").val(1);

					//$("#empleado").html('').select2({data: [ {id: data.id, text: data.empleado}]}); 
					//toastr.info('Codigo de vendedor correcto');
				} else{
					$("#articulo_id").val('');
					$("#articulo").val('');
					$("#cantidadarticulo").val('');
					
				}
				
			});
			} else {
				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');
			}
		}


		$('#articulo_id').focusout(function(e) {

			buscarArticulos($('#articulo_id').val());

		});

		$(document).ready(function(){
			$("#articulo_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
			var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					if ($('#articulo_id').val() == '') $('#articulo').val(''); 
					buscarArticulos($('#articulo_id').val());

				}
			});
		});

		$('#articulo').on('change', function(e){
			if ($('#articulo').val() == '') $('#articulo_id').val(''); 
			buscarArticulos($('#articulo').val());
		});


		/*para agregar articulos al listado*/
		$( "#agregararticulo" ).click(function() {

			
			if($('#articulo_id').val() == ''  || $("#cantidadarticulo").val() == '') {


				toastr.error('No se puede agregar este articulo. Faltan datos');
				return false;
			}

			if(parseInt($("#cantidadarticulo").val()) < 1) {


				toastr.error('La cantidad ingresada no puede ser menor a 1');
				return false;
			}

			//variables para guardar en la grilla
			var codigo = $('#articulo_id').val();
			//var descripcion = $("#descripcionarticulo").val();
			var descripcion =$('select[name="articulo"] option:selected').text();
			var cantidad = parseInt($('#cantidadarticulo').val());

			//cargo la grilla
			$('#table_articulos tbody').prepend(
				'<tr>' + 
				'<td style="display:none;">' + codigo + '</td>' +
				'<td>' + descripcion + '</td>' +
				'<td>' + cantidad + '</td>' +
				"<td><a class='delete btn btn-sm btn-danger' onclick ='deletearticulo_row($(this))'><span class='glyphicon glyphicon-trash'></span></a></td>" +
				'</td>' +
				'</tr>');

				$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');

			toastr.success('Articulo agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}





		$( "#guardar" ).click(function() {


			estadocampos = 0;

			if ($('#fechacontrato').val() == ''){
      			estadocampos = 1;
			   	$('#fechacontratospan').show();
      		} else {
      			$('#fechacontratospan').hide();
      		}

      		if ($('#clientedireccion_id').val() == ''){
      			estadocampos = 1;
			   	$('#direccion_idspan').show();
      		} else {
      			$('#direccion_idspan').hide();
      		}

      		if ($('#modelocontrato_id').val() == ''){
      			estadocampos = 1;
			   	$('#modelocontrato_idspan').show();
      		} else {
      			$('#modelocontrato_idspan').hide();
      		}

		   // listado de articulos
		    var listado = crear_listado_articulos();
      		$('#id_lista_articulos').val(listado);

      		if ($('#id_lista_articulos').val() == ''){
      			estadocampos = 1;
			   	$('#table_articulosspan').show();
      		} else {
      			$('#table_articulosspan').hide();
      		}

      		
      		if(estadocampos == 1) 
      		{
      			toastr.error('No se puede guardar el contrato. Faltan datos');
      			return false;
      		} else {
      			$('#form').submit();
      		}


		   	//$('#form').submit();

		});

		function crear_listado_articulos() {
		    var listado = '';
		    var provincia_id, departamento_id, descripcion;

		    $("#id_lista_articulos").val('');

		    $('#table_articulos tbody tr').each(function () {	 
		    articulo_id = $(this).find("td").eq(0).html();
		    cantidad = $(this).find("td").eq(2).html();

		    listado += articulo_id + "|" + cantidad + "&&&";
		    });

		      return listado;
	    }


	</script>

@endpush