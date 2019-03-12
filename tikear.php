<?php 

	require('conexion.php');


	if(isset($_POST['idU'])&& isset($_POST['estados'])){
		$id=$_POST['idU'];
		$fecha_hoy=$_POST['hoy'];
		$hora_hoy=$_POST['hora'];
		$periodo=$_POST['periodo'];
		$estado=$_POST['estados'];
		$salida=$_POST['salida'];

		$mes=$_POST['mes'];
		
		
		
		//$fecha_hoy=date('m/d/y h:i:s A');

		mysqli_query($enlace, "INSERT INTO asistencia (id_u, entrada, hora, periodo, estado, mes, salida) VALUES('$id','$fecha_hoy','$hora_hoy','$periodo', '$estado', '$mes', '$salida')") or die("error de envio");

		echo "Registro Exitoso ";
	}
	
	echo '';
	
?>