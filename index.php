<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--para qe se vea bien en dispositivos moviles-->
	<title>Registro</title>

	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/tinysort.min.js"></script>
	<script src="js/jquery-3.1.1.min.js"></script>


	
	<script src="js/sweetalert-dev.js"></script>
	
	<link rel="stylesheet" href="js/sweetalert.css">

	<script>
	
		$(function(){



			$('#linkbuscar').click(function(){

				//alert('gogogogo');
				$("li").removeClass("active");
   				$(this.parentNode).addClass("active");

				$('#contenedor').load('reportes.php');
			
			});
			$('#registro').click(function(){

				$("li").removeClass("active");
				$(this.parentNode).addClass("active");
	
				$('#contenedor').load('registrarUsuario.php');
			});
			//$('#resultadoBuscado').html("<p>CONTROL DE ASISTENCIA CONTROL</p>");

			$('#btn_tikear').click(function(){

				enviar();

			});
			$('#btn_salida').click(function(){

				registrar_salida();
			});

			$('#busqueda').keypress(function(e) {
				if(e.which == 13 && $('#busqueda').val()!='' && id!=''){

					enviar();
					return false;
				}
			});

		});

//---------------------para control------------------

	//setIntervl(control, 5000);		
//--------------------------------------------------------------------------------		

		function enviar(){
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
				//var estado='---';
				//var periodo='---';
				//var salida='---';

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
	<style type="text/css">

		body{
			background: #00838f;
			padding-top: 70px;
			padding-bottom: 70px;
		}
		.container-fluid{
			background-image: url('../img/fondo1.png') !important;
		}
		.container{
			min-width: 98% !important;
		}
		#contenedor{
			margin: auto;
			/*background-image: url('../img/fondo1.png') !important;*/
			background: #006064;
			color:#fff;
		}
		#for_buscar{
			max-width: 300px;

		}
		#resultadoBuscado{
			/*border: 2px solid red;*/
			max-width: 100%;
			height: 130px;
			font-size: 35px;
			font-family: arial;
			padding-top: 20px;
			color:#fff;
			text-shadow:1px 1px 4px #AEB1B1;
		}
		#reloj{
			background:#000 ;
			max-width: 500px;
			height: 205px;
			margin: auto ;
			text-align: center;
			padding:30px 0;
			color: #FFFFFF;
			border-radius: 15px;
			box-shadow: 10px 5px 10px black;
		}
		.hora{
			display: inline-block;
			font-size: 110px;
			text-shadow:10px 5px 10px black;
		}
		#hora, #minute, #second{
			width: 125px;
			text-align: center;

		}

		#btn_tikear{
			width: 150px;
		}
		#btn_salida{
			width: 150px;
		}

	</style>
	</head>
<body>
<header>
	<div class="container-fluid">
		<nav id='menu' role="navigation" class="navbar navbar-default navbar-fixed-top ">
	        <div class="navbar-header">
	            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a href="#" class="navbar-brand">Montero Mallo "C"</a>
	        </div>
	 
	        <div id="navbarCollapse" class="collapse navbar-collapse">
	            <ul class="nav navbar-nav">
	                <li class="active"><a href="index.php">Inicio</a></li>
	                <li><a href="#" id="linkbuscar">Buscar Docentes</a></li>
	                <li><a href="#" id="registro">Registrar</a></li>
	               
	            </ul>
	        </div>
		</nav>
	</div>
</header>
<div class="container">
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



<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<center><h5>Autor:JIC<br><a></a></h5></center>
</nav>


<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<link href="js/jquery-ui.css" rel="stylesheet">

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

</body>
</html>