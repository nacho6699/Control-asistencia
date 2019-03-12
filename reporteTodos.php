<?php 

	require('conexion.php');

	$fecha=$_POST['fecha'];
	$mes=$_POST['mes'];



	if($fecha == '' && $mes ==''){
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u
		ORDER by apellido_paterno ASC
			
		");
	}elseif($mes!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u AND asistencia.mes = '$mes'
		ORDER by apellido_paterno ASC	
		");

	}else{
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u AND asistencia.entrada='$fecha'
		ORDER by apellido_paterno ASC
			
		");
	}

			
	
	$filas=mysqli_num_rows($consulta);

	if($filas==0){
		echo '';
	}else{
		$c=1;
		echo "<table class='table'>";
		echo "<thead'>";
		echo "<tr>";
		echo "<th>N°</th>";
		echo "<th>Apellido Paterno</th>";
		echo "<th>Apellido Materno</th>";
		echo "<th>Nombre(s)</th>";
		echo "<th>Hora de entrada</th>";
		echo "<th>Hora de salida</th>";
		echo "<th>Fecha de entrada</th>";
		echo "<th>Periodo</th>";
		echo "<th>Observación</th>";
		echo "</tr>";
		echo "</thead>";
		while ($resultados = mysqli_fetch_array($consulta)) {
			$apellidoP=$resultados['apellido_paterno'];
			$apellidoM=$resultados['apellido_materno'];
			$nombres=$resultados['nombre'];

			$fecha_entrada=$resultados['entrada'];
			$hora_entrada=$resultados['hora'];
			$periodo=$resultados['periodo'];
			$estado=$resultados['estado'];
			$salida=$resultados['salida'];
			
			echo "<tbody>";
			echo "<tr>";
			echo "<td>$c</td>";
			echo "<td>$apellidoP</td>";
			echo "<td>$apellidoM</td>";
			echo "<td>$nombres</td>";

			echo "<td>$hora_entrada</td>";
			echo "<td>$salida</td>";
			echo "<td>$fecha_entrada</td>";
			echo "<td>$periodo</td>";
			echo "<td>$estado</td>";
			echo "</tr>";
			echo "</tbody>";
			$c++;
		}
		echo "</table>";
		//echo "<button id='btn_printTodo' class='btn btn-success'>Imprimir Reporte</button>";
	}


?>