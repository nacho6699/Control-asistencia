<?php 

	require('conexion.php');

	$buscado=$_POST['valor'];

if(isset($buscado)){

		$consulta=mysqli_query($enlace,"
		select *
		from usuario
		where nombre like '%$buscado%'
		OR apellido_paterno like '$buscado%'
		OR apellido_materno like '$buscado%'
		OR CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) like '$buscado%'
		OR CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) like '$buscado%'
		OR CONCAT(apellido_paterno,' ',nombre) like '$buscado%'
			
		");
	
	$filas=mysqli_num_rows($consulta);

	if($filas==0){
		$mensaje[]='';
	}else{
		//echo 'Resultados para :<strong>'.$buscado.'</strong>';
		while ($resultados = mysqli_fetch_array($consulta)) {
			$mensaje[]=$resultados;
		}
	}
}
echo json_encode($mensaje);
?>