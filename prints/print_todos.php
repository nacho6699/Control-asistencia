<?php 


require('../lib/pdf/mpdf.php');
require('../conexion.php');




	$fecha=$_POST['fecha'];
	$mes=$_POST['mes'];
	$con=1;


	if($fecha == '' && $mes ==''){
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u
		ORDER by apellido_paterno ASC, fecha_actualizacion
			
		");
	}elseif($mes!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u AND asistencia.mes = '$mes'
		ORDER by apellido_paterno ASC, fecha_actualizacion 	
		");

	}else{
		$consulta=mysqli_query($enlace,"
		select *
		from usuario, asistencia
		where usuario.id_u=asistencia.id_u AND asistencia.entrada='$fecha'
		ORDER by apellido_paterno ASC, fecha_actualizacion
			
		");
	}

			
	
	$filas=mysqli_num_rows($consulta);

	if($filas==0){
		echo '';
	}else{

			

		/* while ($resultados = mysqli_fetch_array($consulta)) {
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
		
		}*/



$contenido='
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      
      <h3>COLEGIO NACIONAL MIXTO MEJILLONES "B"</h3>
      <div id="project">
        <div><span>REPORTE DE AISTENCIA </span></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
          	<th>N°</th>
            <th class="service">Apellido Paterno</th>
            <th class="desc">apellido Materno</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
          </tr>
        </thead>
        <tbody>';
        while ($resultados = mysqli_fetch_array($consulta)){
        	$contenido.='<tr>
        					<td>'.$con.'</td>	
				            <td class="service">'.$resultados['apellido_paterno'].'</td>
				            <td class="desc">'.$resultados['apellido_materno'].'</td>
				            <td class="desc">'.$resultados['nombre'].'</td>
				            <td class="qty">'.$resultados['entrada'].'</td>
				            <td class="total">'.$resultados['hora'].'</td>
				            <td class="total">'.$resultados['salida'].'</td>
				         </tr>';
				         $con++;
        }

        $contenido.=' 
         </tbody>
      </table>
 
    </main>
    <footer>
      Colegio Nacional Mixto Mejillones "B"
    </footer>
  </body>
</html>';

  		$pdf=new mPDF('c', 'letter');
  		//$css=file_get_contents('css/style.css');
		$pdf->writeHTML($contenido);
		$pdf->writeHTML($css);
		$pdf->Output("pdfsave/reporte.pdf", 'F');

		echo "<center><iframe id='cont_pddf' src='prints/pdfsave/reporte.pdf' width='650' height='610' frameborder='0'></iframe></center>";
		//echo "<embed src='pdfsave/reporte.pdf' width='500' height='400' href='pdfsave/reporte.pdf'>";
}
 ?>