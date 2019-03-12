<?php 
//$enlace = mysqli_connect('10.10.166.83', 'practica', 'practica7', 'testuatf');
$enlace = mysqli_connect('localhost', 'root', '', 'montero');
	if (!$enlace) {
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
	//echo "Conexion exitosa" . PHP_EOL;
	//mysqli_set_charset('utf8');
	mysqli_set_charset ( $enlace , 'utf8' );
	//cerrar
	//echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;
	//mysqli_close($enlace);
 ?>