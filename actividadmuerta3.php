<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html lang="es">
    <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro Exitoso</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Formularios.css" rel="stylesheet">
    </head>
    <body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="mainOperario.php">Waka-s Textiles</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="mainOperario.php">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
        <?php
            if(isset($_POST['finalizar'])){
                date_default_timezone_set('America/Lima');
                $fecha=date("m/d/Y");
        		$aux = 0;
                $result = selectTable("EmpleadoActividadMuerta");
                while($fila = mysql_fetch_array($result)){
                    $aux++;
                }
                $aux++;
                $idempactmuerta=$aux;
                $actimuerta="INSERT INTO empleadoactividadmuerta(idEmpleadoActividadMuerta, idEmpleado, idActividadMuerta, descripcion, tiempo, fecha) VALUES ('".$idempactmuerta."','".$_POST['idempleado']."','".$_POST['actimuerta']."','".$_POST['desc']."','".$_POST['tiempo']."','".$fecha."')";
                $insert=mysql_query($actimuerta);
                if ( !empty( $error = mysql_error() ) ) {
                    echo 'Mysql error '. $error ."<br />\n";
                }else{
                }
            }
        ?>
        <section class="container">
            <h4 class="h4operario">¡Felicitaciones ha ingresado los datos con &eacute;xito!</h4>
        </section>
        <br>
        <section class="container">
            <form action="mainOperario.php" class="form-horizontal jumbotron col-xs-12">
                <input class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" value="Regresar al Men&uacute;">
            </form>
        </section>
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 			<script src="js/bootstrap.min.js"></script>
    </body>
    <footer>

    </footer>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>