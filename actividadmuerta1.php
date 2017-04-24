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
        <title>Registar datos</title>
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
    <section class="container">
        <form action="actividadmuerta2.php" method="post" class="form-horizontal jumbotron col-xs-12">
            <div>
                <h4>Registrar mi tiempo muerto</h4>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="dni" class="formlabelscel col-xs-12">DNI:</label>
                </div>
                <div class="col-xs-12">
                    <input class="textinput-12" id="dni" type="text" name="idempleado" value="<?php echo $_POST['idempleado'];?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="actividad" class="formlabelscel col-xs-12">Seleccione Tiempo Muerto:</label>
                </div>
                <div class="col-xs-12">
                    <select id="actividad" name="actimuerta" class="ddselect-12">
                        <option>Seleccionar</option>
                        <?php
                        $result=selectTable("ActividadMuerta");
                        while ($fila=mysql_fetch_array($result)){
                            echo "
                                <option value='".$fila['idActividadMuerta']."'>".$fila['descripcion']."</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="descripcion" class="formlabelscel col-xs-12">Descripci&oacute;n:</label>
                </div>
                <div class="col-xs-12">
                    <input id="descripcion" type="text" name="desc" class="textinput-12">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="time" class="formlabelscel col-xs-12">Tiempo Empleado (Minutos):</label>
                </div>
                <div class="col-xs-12">
                    <input id="time" type="text" name="tiempo" class="textinput-12">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" name="siguiente" value="Guardar">
                </div>
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