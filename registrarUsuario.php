<?php 

	require('conexion.php');


	if(isset($_POST['txt_ci'])&& isset($_POST['txt_nombres'])&& isset($_POST['txt_paterno'])&& isset($_POST['txt_materno'])&& isset($_POST['txt_telefono'])&& isset($_POST['txt_materia'])){
		$ci=$_POST['txt_ci'];
		$nombres=$_POST['txt_nombres'];
		$paterno=$_POST['txt_paterno'];
		$materno=$_POST['txt_materno'];
		$telefono=$_POST['txt_telefono'];
		$materia=$_POST['txt_materia'];
        
        //mysqli_query($enlace, "INSERT INTO usuario (ci, nombre, apellido_paterno, apellido_materno, telefono, materia) VALUES('$ci','$nombres','$paterno','$materno', '$telefono', '$materia')") or die("error de envio");

		//echo "Registro Exitoso ";
		//echo "SALIDA REGISTRADA". mysql_affected_rows();;

	}
	
	echo '';
	
?>

    <div class="row">
        <div class="col col-lg-6 col-md-offset-3 ">
        <form method="post" action="registrarUsuario.php">
            <div class="form-group">
                <label for="formGroupExampleInput">Cédula de identidad</label>
                <input type="text" class="form-control" name="txt_ci" id="formGroupExampleInput" placeholder="C.I.">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Nombres</label>
                <input type="text" name="txt_nombres" class="form-control" id="formGroupExampleInput2" placeholder="Nombres">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Apellido Paterno</label>
                <input type="text" name="txt_paterno" class="form-control" id="formGroupExampleInput2" placeholder="Apellido paterno">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Apellido Materno</label>
                <input type="text" name="txt_materno" class="form-control" id="formGroupExampleInput2" placeholder="Apellido materno">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Teléfono</label>
                <input type="text" name="txt_telefono" class="form-control" id="formGroupExampleInput2" placeholder="Apellido materno">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Materia</label>
                <input type="text" name="txt_materia" class="form-control" id="formGroupExampleInput2" placeholder="Apellido materno">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-default">Cancelar</button>
            </form>
        </div>
    </div>
