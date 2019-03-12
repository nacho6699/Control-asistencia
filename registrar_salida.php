<?php 

	require('conexion.php');


	if(isset($_POST['idU'])&& isset($_POST['hoy'])&& isset($_POST['hora'])){
		$id=$_POST['idU'];
		$hoy=$_POST['hoy'];
		$hora_hoy=$_POST['hora'];


		mysqli_query($enlace, "UPDATE asistencia SET salida='$hora_hoy' WHERE id_u = '$id' and entrada = '$hoy'") or die("error de envio");

		echo "SALIDA REGISTRADA". mysql_affected_rows();;

	}
	
	echo '';
	
?>