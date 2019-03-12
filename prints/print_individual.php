<?php 


require('../lib/pdf/mpdf.php');
require('../conexion.php');




	$id=$_POST['valor'];
	$fecha=$_POST['fecha'];
	$mes=$_POST['mes'];
	$ap=$_POST['ap'];
	$am=$_POST['am'];
	$nom=$_POST['nom'];
	$con=1;

	if($fecha!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from asistencia, usuario
		where asistencia.id_u=usuario.id_u AND asistencia.id_u=$id AND asistencia.entrada = '$fecha'
		ORDER by entrada	
		");

	}elseif($mes!=''){
		$consulta=mysqli_query($enlace,"
		select *
		from asistencia, usuario
		where asistencia.id_u=usuario.id_u AND asistencia.id_u=$id AND asistencia.mes = '$mes'
		ORDER by entrada	
		");

	}else{

		$consulta=mysqli_query($enlace,"
		select *
		from asistencia,usuario
		where asistencia.id_u=usuario.id_u AND asistencia.id_u=$id
		ORDER by entrada ASC	
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
			<td class="service">'.$resultados['apellido_paterno'].'</td>
				            <td class="desc">'.$resultados['apellido_materno'].'</td>
				            <td class="desc">'.$resultados['nombre'].'</td>
		
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
        <div>Prof. '.$ap. ' '.$am.' '.$nom.'</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
          	<th>N°</th>
            <th class="service">Fecha Entrada</th>
            <th class="desc">Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Periodo</th>
            <th>Observación</th>

          </tr>
        </thead>
        <tbody>';
        while ($resultados = mysqli_fetch_array($consulta)){
        	$contenido.='<tr>
        					<td>'.$con.'</td>
				            <td class="service">'.$resultados['entrada'].'</td>
				            <td class="desc">'.$resultados['hora'].'</td>
				            <td class="desc">'.$resultados['salida'].'</td>
				            <td class="qty">'.$resultados['periodo'].'</td>
				            <td class="total">'.$resultados['estado'].'</td>
				
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
echo $contenido;
  		$pdf=new mPDF('c', 'letter');
  		//$css=file_get_contents('css/style.css');
		$pdf->writeHTML($contenido);
		$pdf->writeHTML($css);
		$pdf->Output("pdfsave_individual/$ap $am $nom.pdf", 'F');

		echo "<center><iframe id='cont_pddf' src='prints/pdfsave_individual/$ap $am $nom.pdf' width='650' height='610' frameborder='0'></iframe></center>";
		//echo "<embed src='pdfsave/reporte.pdf' width='500' height='400' href='pdfsave/reporte.pdf'>";
}
 ?>