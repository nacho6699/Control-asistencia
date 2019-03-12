<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="jquery-3.1.1.min.js"></script>
	<script>
	$(function(){
		$('#resultadoBuscado').html("<p>Aun no buscaste</p>");
	});

	function buscar(){
		var textBusqueda=$('#busqueda').val();
		if(textBusqueda!=''){
			$.post('buscar.php', {valor:textBusqueda}, function(msj){
				$('#resultadoBuscado').html(msj);
			});
		}
		else{
			$('#resultadoBuscado').html('<p>esta vacio</p>');
		}
	};

	</script>
</head>
<body>
	<strong>Buscar:</strong>
	<form method="POST" accept-charset="utf-8">
		<input type="text" name="busqueda" id="busqueda" autocomplete="off" onkeyup="buscar();">
	</form>

	<div id="resultadoBuscado"></div>
</body>
</html>