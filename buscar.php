<?php 

	require('conexion.php');
	
	$buscado=$_POST['valor'];
		//$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
		//$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
		//$buscado= str_replace($caracteres_malos, $caracteres_buenos, $buscado);

if(isset($buscado)){

		$consulta=mysqli_query($enlace,"
		select *
		from usuario
		where ci like '$buscado%'
		");
	
	$filas=mysqli_num_rows($consulta);

	if($filas==0){
		$mensaje[]='';
	}else{
	
		while ($resultados = mysqli_fetch_array($consulta)) {
			$mensaje[]=$resultados;
		}
	}
}
echo json_encode($mensaje);

?>