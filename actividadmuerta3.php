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
        <meta name="apple-mobile-web-app-title" content="Waka-s">
        <meta name="application-name" content="Waka-s">
        <meta name="theme-color" content="#ef4a43">
        <title>Registro Exitoso</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="css/Formularios.css" rel="stylesheet">
    </head>
    <body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="mainOperario.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="mainOperario.php">Inicio</a></li>
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
                if($_POST['maquina']==null||$_POST['maquina']==''){
                    $tipo = 'General';
                }else{
                    $tipo = 'Maquina';
                }
                $actimuerta="INSERT INTO empleadoactividadmuerta(idEmpleadoActividadMuerta, idEmpleado, idActividadMuerta, idMaquina, tipo, descripcion, tiempo, fecha) VALUES ('".$idempactmuerta."','".$_POST['idempleado']."','".$_POST['actimuerta']."','".$_POST['maquina']."','".$tipo."','".$_POST['desc']."','".$_POST['tiempo']."','".$fecha."')";
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
                <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" value="Regresar al Men&uacute;">
            </form>
        </section>
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 			<script src="js/bootstrap.min.js"></script>
    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.<br>Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>