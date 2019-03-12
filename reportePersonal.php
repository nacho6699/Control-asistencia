<?php 

	require('conexion.php');

	$id=$_POST['valor'];
	$fecha=$_POST['fecha'];
	$mes=$_POST['mes'];

if(isset($id)){

	if($fecha!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from asistencia
		where asistencia.id_u=$id AND asistencia.entrada = '$fecha'
			
		");

	}elseif($mes!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from asistencia
		where asistencia.id_u=$id AND asistencia.mes = '$mes'
			
		");

	}else{

		$consulta=mysqli_query($enlace,"
		select *
		from asistencia
		where asistencia.id_u=$id
			
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
		echo "<th>Hora de entrada</th>";
		echo "<th>Hora de salida</th>";
		echo "<th>Fecha de entrada</th>";
		echo "<th>Periodo</th>";
		echo "<th>Observación</th>";
		echo "</tr>";
		echo "</thead>";
		while ($resultados = mysqli_fetch_array($consulta)) {
			$fecha_entrada=$resultados['entrada'];
			$hora_entrada=$resultados['hora'];
			$periodo=$resultados['periodo'];
			$estado=$resultados['estado'];
			$salida=$resultados['salida'];
			
			echo "<tbody>";
			echo "<tr>";
			echo "<td>$c</td>";
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
		//echo "<button id='btn_print' class='btn btn-success'>Imprimir Reporte</button>";

	}
}

?>
