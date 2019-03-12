
<?php require("header.php")?>

	
	<div class="panel panel-default">
	<center>
		<div id="contenedor" class="panel-body">
			<div id='control'>
				<strong><div id="resultadoBuscado">CONTROL DE ASISTENCIA</div></strong>

				<form id="for_buscar" accept-charset="utf-8">
					<div class="input-group form-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input id="busqueda" type="number" class="form-control"  name="busqueda" placeholder="INTRODUZCA SU CI" onKeyUp="buscar();" autocomplete="off" required autofocus>
					</div>
				</form>

				<button id="btn_tikear" class="btn btn-primary" disabled="true">ENTRADA</button>
				<button id="btn_salida" class="btn btn-danger" disabled="true">SALIDA</button><br><br>

				<div id="reloj">
					<div class="hora" id="hora">00</div>
					<div class="hora" >:</div>
					<div class="hora" id="minute">00</div>
					<div class="hora" >:</div>
					<div class="hora" id="second">00</div> 
				</div>
			</div>
		</div>
	</center>  
		<!--<div class="panel-footer fixed-button">Panel Footer</div>-->
	</div>
</div>



<!-- funcion del relof -->
<script>
	function relog(){
		var tiempo = new Date();
		var hora=tiempo.getHours();
		var min=tiempo.getMinutes();
		var secon=tiempo.getSeconds();

		$('#hora').text(hora);
		$('#minute').text(min);
		$('#second').text(secon);
	}setInterval('relog()',1000);

</script>
<!--esto es todo la funcionalidad del script-->
<script>
	
	$(function(){

		$('#linkbuscar').click(function(){
			$("li").removeClass("active");
			$(this.parentNode).addClass("active");
			$('#contenedor').load('reportes.php');
		});

		$('#registro').click(function(){
			$("li").removeClass("active");
			$(this.parentNode).addClass("active");
			$('#contenedor').load('registrarUsuario.php');
		});
	
		$('#btn_tikear').click(function(){
			registrar_entrada();
		});

		$('#btn_salida').click(function(){
			registrar_salida();
		});
		//esta parte es para registrar la entrada con la tecla enter
		$('#busqueda').keypress(function(e) {
			if(e.which == 13 && $('#busqueda').val()!='' && id!=''){
				registrar_entrada();
				return false;
			}
		});

	});

//---------------------para control------------------

//setIntervl(control, 5000);		
//--------------------------------------------------------------------------------		

	function registrar_entrada(){
		var tiempo = new Date();
			var dia=tiempo.getDate();
			var mes=tiempo.getMonth()+1;
			var año=tiempo.getFullYear();
			var hora=tiempo.getHours();
			var min=tiempo.getMinutes();
			var secon=tiempo.getSeconds();
			var fecha_hoy=año + '-'+ mes + '-' + dia;
			var hora_hoy=hora + ':' + min + ':' +secon;
			var estado='---';
			var periodo='---';
			var salida='---';

			if(hora == 13 && min <=30){
				estado='Puntual';
				periodo='Primero';
			}
			if(hora == 13 && min > 30 && min <=40){
				estado='Retrazo';
				periodo='Primero';
			}
			//---------segundo periodo----------------
			if(hora >= 14 && hora <= 15 && min >= 0  ){
				estado='Puntual';
				periodo='Segundo';
			}
			if(hora == 15 && min <=10){
				estado='Retrazo';
				periodo='Segundo';
			}
			//---------tercer periodo----------------
			if(hora ==16 && min >= 0 && min <=20){
				estado='Puntual';
				periodo='Tercero';
			}
			if(hora == 16 && min > 20 && min <= 30){
				estado='Retrazo';
				periodo='Tercero';
			}

			var datos={idU:id, hoy:fecha_hoy, hora:hora_hoy, periodo:periodo, estados:estado, mes:mes, salida:salida};
			//alert(hoy);

			$.ajax({
							type: "POST",
							data: datos,
							url: "tikear.php",
						 success: function(a) {
							 if(a==''){
								 $(location).attr('href' , 'http://localhost:80/controlAsistencia');
							 }else{	
								 swal({
										 title: a,
								text: "Preciona OK",
								timer: 0,
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "OK",
								closeOnConfirm: true
								 }, function(){
									 //$(location).attr('href' , 'http://localhost:8080/controlAsistencia');
									 $('#busqueda').val('');
									 $('#busqueda').focus();
									 $('#resultadoBuscado').html('<p>CONTROL DE ASISTENCIA</p>');
									 $('#btn_tikear').prop('disabled', true);
									 $('#btn_salida').prop('disabled', true);
								 });
				
							 }
							}
			});
	}
//-------------------------para la salida------------------------------
	function registrar_salida(){
		var tiempo = new Date();
			var dia=tiempo.getDate();
			var mes=tiempo.getMonth()+1;
			var año=tiempo.getFullYear();
			var hora=tiempo.getHours();
			var min=tiempo.getMinutes();
			var secon=tiempo.getSeconds();
			var fecha_hoy=año + '-'+ mes + '-' + dia;
			var hora_hoy=hora + ':' + min + ':' +secon;

			var datos={idU:id, hoy:fecha_hoy, hora:hora_hoy};

			$.ajax({
							type: "POST",
							data: datos,
							url: "registrar_salida.php",
						 success: function(a) {
							 if(a==''){
								 alert('no registro su entrada');
								 $(location).attr('href' , 'http://localhost:80/controlAsistencia');
							 }else{	
								 swal({
										 title: a,
								text: "Preciona OK",
								timer: 0,
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "OK",
								closeOnConfirm: true
								 }, function(){
									 //$(location).attr('href' , 'http://localhost:8080/controlAsistencia');
									 $('#busqueda').val('');
									 $('#busqueda').focus();
									 $('#resultadoBuscado').html('<p>CONTROL DE ASISTENCIA</p>');
									 $('#btn_tikear').prop('disabled', true);
									 $('#btn_salida').prop('disabled', true);

								 });
								 
							 }
							}
			});
		}
//----------------------------------------------------------

var id='';
function buscar(){
	var textBusqueda=$('#busqueda').val();
	if(textBusqueda!=''){

		$.post('buscar.php', {valor:textBusqueda}, function(msj){
			var user=JSON.parse(msj);
			id=user[0].id_u;
			if(user==''){
				$('#resultadoBuscado').html('Docente No Registrado');
				$('#btn_tikear').prop('disabled', true);
				$('#btn_salida').prop('disabled', true);
			}else{
				//console.log(msj);
				$('#resultadoBuscado').html(user[0].nombre+' '+user[0].apellido_paterno+' '+user[0].apellido_materno);
				$('#btn_tikear').prop('disabled', false);
				$('#btn_salida').prop('disabled', false);
			}
		});
	}
	else{
		$('#resultadoBuscado').html('<p>CONTROL DE ASISTENCIA</p>');
		$('#btn_tikear').prop('disabled', true);
		$('#btn_salida').prop('disabled', true);
	}
};
</script>
<?php include("footer.php")?>