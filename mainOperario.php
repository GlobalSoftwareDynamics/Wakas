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
        <title>Portal Operativo</title>
        <link href="css/bootstrap.css" rel="stylesheet">
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
            $nombre =$_SESSION['nombre'];
            $result="SELECT * FROM empleado WHERE nombres ='".$nombre."'";
            $result1=mysql_query($result);
            while ($fila=mysql_fetch_array($result1)){
                $idempleado=$fila['idEmpleado'];
            }
        ?>
        <section class="container">
            <div class="col-xs-12">
                <h3 class="h3operario">Bienvenido al Portal Operativo</h3>
            </div>
            <div class="col-xs-12">
                <h4 class="h4operario">¿Qu&eacute; deseas hacer?</h4>
            </div>
        </section>
        <section class="container-fluid">
            <form method="post" class="form-horizontal jumbotron col-xs-12">
                <input type="hidden" name="idempleado" value="<?php echo $idempleado;?>">
                <div class="col-xs-12">
                    <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" formaction="regingreso.php" name="menuingreso" value="Registrar Ingreso/Salida">
                </div>
                <br>
                <br>
                <div class="col-xs-12">
                    <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" formaction="regBreak.php" name="regBreak" value="Registrar Salida/Ingreso a Refrigerio">
                </div>
                <br>
                <br>
                <div class="col-xs-12">
                    <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" formaction="regproceso.php" name="regproceso" value="Registrar un Proceso">
                </div>
                <br>
                <br>
                <div class="col-xs-12">
                    <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" formaction="actividadmuerta1.php" name="regactmuerta" value="Registrar Tiempo Muerto">
                </div>
            </form>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>
    <footer class="panel-footer navbar-fixed-bottom">
        <div class="container col-sm-6 col-sm-offset-3 text-center">
            <span>© 2017 by Global Software Dynamics.<br>Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
        </div>
    </footer>
    </body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>