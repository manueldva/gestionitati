
<input type="hidden" name="listado_articulos" id="id_lista_articulos">
<div class="row">
	<div class="col-md-12">	

	  <div class="box box-default">
	  	<div class="box-header with-border">


	      <h3 class="box-title">
	      	
	      </h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
			<div class="col-md-4">
			  <!--<div class="box box-default">-->
			    <div class="box-header with-border">
			     

			      <h3 class="box-title">Datos de la venta:</h3>
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body">
			    	<div class="form-group">
						{{ form::label('codigo', 'Codigo Venta') }}
						{{ form::text('id', null, ['class' => 'form-control', 'id' => 'id', 'readonly']) }}
					</div>

			    	<div class="form-group">
						{{ form::label('empleado_id', 'Vendedor') }}
						{{ form::text('empleado_id', Auth::user()->username, ['class' => 'form-control', 'id' => 'empleado_id', 'readonly']) }}
					</div>
					<div class="form-group">
						{{ form::label('fecha', 'Fecha') }}
						{{ form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) }}
					</div>
			      	<div class="form-group">
						{{ form::label('cliente_id', 'Nro Socio') }}
						{{ form::number('cliente_id',null, ['class' => 'form-control', 'id' => 'cliente_id']) }}
					</div>
					<div class="form-group">
						{{ form::label('cliente', 'Cliente') }}
						{{ form::text('cliente',null, ['class' => 'form-control', 'id' => 'cliente', 'readonly']) }}
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
			      

			      <h3 class="box-title">Detalle Articulos:</h3>
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


	


<!--      segundo div general                              -->

	<!-- /.col -->





@push('js')
	<!-- todo lo que tenga que realizar un ajax -->
	<script type="text/javascript">

		
		var APP_URL = "{{ url('/') }}";

		$(document).ready(function(){
			$("#cliente_id").keypress(function(e) {
			//no recuerdo la fuente pero lo recomiendan para
			//mayor compatibilidad entre navegadores.
				var code = (e.keyCode ? e.keyCode : e.which);
				if(code==13){
					cliente_id = $("#cliente_id").val();
					buscarcliente(cliente_id);
				}
			});
		});

		$('#cliente_id').focusout(function(e) {

			cliente_id = $("#cliente_id").val();
			buscarcliente(cliente_id);

		});


		function buscarcliente(cliente_id) {

			$.ajax({
           	dataType: 'json',
			url: APP_URL + '/api/clienteventa',
			//url: '../api/validardocumento',
			data: {q: cliente_id},
               success: function(data) {
                  //console.log(data); // As moonwave99 said
                if(data == 0) {
                	$("#cliente").val('');
                	//toastr.error('Sin Datos');
                } else {
                	if(data.tipocliente_id == 1) {
						
						$("#cliente").val(data.apellido +' '+data.nombre);
	                }else {
	                	$("#cliente").val(data.cliente);
	                }
	                toastr.success('Cliente encotrado');
                }
                  
               },
               error: function() {
               		$("#cliente").val('');
                	//toastr.error('Sin Datos');
               }
	        });


		}




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

				/*$("#articulo_id").val('');
				$("#articulo").val('');
				$("#cantidadarticulo").val('');*/
			
			buscarArticulos(0);

			toastr.success('Articulo agregado a la lista');
			

		});


		/*borrar filas del listado de articulos*/
		function deletearticulo_row(row) {

		  	row.closest('tr').remove();
		  	toastr.info('Articulo eliminado de la lista');
		}


		


		$( "#guardar" ).click(function() {


			
		    // listado de articulos
		    var listado = crear_listado_articulos();
      		$('#id_lista_articulos').val(listado);

      		//alert(listado);

      		if($('#id_lista_articulos').val() == ''){
      			toastr.error('Ocurrio un error, verifique los campos del listado final');
      			return false;
      		} else {

      			if($('#cliente').val() == ''){
      				$('#cliente_id').val('');
      			}
      			//alert($('#id_lista_stocks').val());
      			$('#form').submit();
      		}
      		
      		
      	


		   	//$('#form').submit();

		});

		

	   	function crear_listado_articulos() {
		    var listado = '';

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