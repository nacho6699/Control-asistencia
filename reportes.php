	<script>
	var id='';
	var ap='';
	var am='';
	var nom='';


	$(function(){

		$('#btn_verreporte').click(function(){

			var fecha_buscar=$('#txt_fecha').val();
			//alert(fecha_buscar);
			var mes=$('#meses option:selected').val();

		
			$.post('reportePersonal.php', {valor:id, fecha:fecha_buscar, mes:mes}, function(dato){
				if(dato==''){
					$('#tablas').html('<h3>No existe ningun registro</h3>');
				}else{
					$('#tablas').html(dato);
					//$('#btn_imprimirIndividual').fadeOut();
				}

			});

		})
		//-----------para vertodos---------
		$('#btn_vertodos').click(function(){
			$('#Dpersonales').html('');
			$('#txtDocente').val('');
			var fecha_2=$('#txt_fecha').val();
			var mes=$('#meses option:selected').val();
			//alert(mes);
			$.post('reporteTodos.php', {fecha:fecha_2, mes:mes}, function(dato){
				if(dato==''){
					$('#tablas').html('<h3>No existe ningun registro</h3>');
				}else{
					$('#tablas').html(dato);
					//$('#btn_imprimirIndividual').fadeOut();
				}

			});
		});
	});
	//----------para bloquear campos por mes y dia-------------

	$("#meses").change(function() {

		if($('#meses option:selected').val()!=''){
			$('#txt_fecha').val('');
			$('#txt_fecha').prop('disabled', true);
		}else{
			$('#txt_fecha').prop('disabled', false);
		}
	});
	$("#txt_fecha").change(function() {

		if($('#txt_fecha').val()!=''){
			$('#meses option:selected').val('');
			$('#meses').prop('disabled', true);
		}else{
			$('#meses').prop('disabled', false);
		}
	});
	//---------------------------------------------------------

	function buscarDocente(){
		var docente=$('#txtDocente').val();
		$('#tablas').html('');
		if(docente!=''){
				//alert(docente);
			$.post('sacardatos.php', {valor:docente}, function(msj){
				//console.log(msj);
				var user=JSON.parse(msj);
				id=user[0].id_u;
				ap=user[0].apellido_paterno;
				am=user[0].apellido_materno;
				nom=user[0].nombre;
				//alert(ap);
				if(user==''){
					$('#Dpersonales').html('Docente NO registrado');
					$('#btn_verreporte').prop('disabled', true);
				}else{
					//console.log(msj);
					$('#Dpersonales').html('Resultados para :<strong>'+docente+'</strong><br>');
					$('#Dpersonales').append(
						"<strong>Nombre : </strong>"+user[0].nombre+'<br>'+
						"<strong>Apellido P : </strong>"+user[0].apellido_paterno+'<br>'+
						"<strong>apellido M : </strong>"+user[0].apellido_materno+'<br>'+
						"<strong>Tel./Cel : </strong>"+user[0].telefono+'<br>'+
						"<strong>Materias : </strong>"+user[0].materia
						);
					$('#btn_verreporte').prop('disabled', false);
				}

			});
		}
		else{
			$('#Dpersonales').html('<p>Debe escribir algun nombre</p>');
			$('#btn_verreporte').prop('disabled', true);
		}
	};

	//para amplimir personal------

	$('#btn_print').click(function(){
			$('#Dpersonales').html('');
			$('#txtDocente').val('');
			var fecha_2=$('#txt_fecha').val();
			var mes=$('#meses option:selected').val();
			//alert(mes+' '+fecha_2);
			$.post('prints/print_todos.php', {fecha:fecha_2, mes:mes}, function(dato){
				if(dato==''){
					$('#tablas').html('<h3>No existe ningun registro para imprimir</h3>');
				}else{
					$('#tablas').html(dato);
					//$('#btn_imprimirIndividual').fadeOut();
					//$(location).attr('href' , 'http://localhost/controlAsistencia/prints/print_todos.php');

				}

			});
	
	});
	//----------imprimir individual------------------------
		$('#btn_imprimir_individual').click(function(){

			var fecha_buscar=$('#txt_fecha').val();
			//alert(fecha_buscar);
			var mes=$('#meses option:selected').val();
			if($("#txtDocente").val()!=''){
		
			$.post('prints/print_individual.php', {valor:id, fecha:fecha_buscar, mes:mes, ap:ap, am:am, nom:nom}, function(dato){
				if(dato==''){
					$('#tablas').html('<h3>No existe ningun registro</h3>');
				}else{
					$('#tablas').html(dato);
					//$('#btn_imprimirIndividual').fadeOut();
				}

			});
			}else{
				alert("DEBE ESCRIBIR ALGUN NOMBRE ...");
			}

		})
	</script>

	
	<div class="container-fluid">
		<div class="row"><h3>BUSCAR DOCENTE</h3></div>
		<div class="row">
			<div id='buscar_individual' class="col-xs-4">
			<form id="for_Bdocente" accept-charset="utf-8">

				<div class="input-group form-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input id="txtDocente" type="text" class="form-control"  name="" placeholder="Nombre o Apellido" onKeyUp="buscarDocente();" autocomplete="off" required autofocus>
				</div>
				
			</form>
			<button id="btn_verreporte" class="btn btn-warning" disabled="true">Ver Registro Individual de Docente</button>
			<button id="btn_imprimir_individual" class="btn btn-info"  >Imprimir</button>
			</div>

			<div id='buscar_todos' class="col-xs-3">
				<div class="input-group form-group">
					<span class="input-group-addon">Día Exacto</span>
					<input id="txt_fecha" type="date" class="form-control"  name="">
				</div>
			</div>

			<div id='buscar_mes' class="col-xs-3">
				<div id='tipobeca' class="input-group form-group">
					<span class="input-group-addon">Elegir MES</span>
					<select id="meses" class="form-control" required>
					  <option value=''></option>
					  <option value='1'>Enero</option>
					  <option value='2'>Febrero</option>
					  <option value='3'>Marzo</option>
					  <option value='4'>Abril</option>
					  <option value='5'>Mayo</option>
					  <option value='6'>Junio</option>
					  <option value='7'>Julio</option>
					  <option value='8'>Agosto</option>
					  <option value='8'>Septiembre</option>
					  <option value='10'>Octubre</option>
					  <option value='11'>Noviembre</option>
					  <option value='12'>Diciembre</option>
					</select>
				</div>
			</div>

			<div id='buscar_todos' class="col-xs-2">
				<button id="btn_vertodos" class="btn btn-default btn-sm">VER REGISTRO DE TODOS</button>
			</div>

		</div><br>

		<div class="row">
			<div id='Dpersonales' class="col-xs-3">
				<p>Debe escribir algun nombre</p>
			</div>
			<div id='tablas' class="col-xs-9 ">
				...
			</div>
			<button id='btn_print' class='btn btn-success'>Imprimir Reporte General</button>
		</div>
	</div>
