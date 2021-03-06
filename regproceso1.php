<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();
if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
?>
<html>
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
    <h4>Revise los datos:</h4>
    <form action="regproceso2.php" method="post" class="form-horizontal jumbotron col-xs-12">
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
                <label for="lot" class="formlabelscel col-xs-12">Lote:</label>
            </div>
            <div class="col-xs-12">
                <input class="textinput-12" id="lot" type="text" name="idlote" value="<?php echo $_POST['idlote'];?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="prod" class="formlabelscel col-xs-12">Producto:</label>
            </div>
            <div class="col-xs-12">
                <input type="text" class="textinput-12" id="prod" value="<?php echo $_POST['producto'];?>" name="producto" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="proceso" class="formlabelscel col-xs-12">Proceso:</label>
            </div>
            <div class="col-xs-12">
                <input type="hidden" class="textinput-12" value="<?php echo $_POST['proce'];?>" readonly>
                <?php
                $result2=selectTableWhere("Proceso","idProceso","'".$_POST['proce']."'");
                while ($fila2=mysql_fetch_array($result2)){
                    echo "<input type='text' id='proceso' class='textinput-12' value='".$fila2['descripcion']."' readonly>";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="procedi" class="formlabelscel col-xs-12">Procedimiento:</label>
            </div>
            <div class="col-xs-12">
                <input type="hidden" name="procedimiento" value="<?php echo $_POST['procedimiento'];?>" readonly>
                <?php
                $result2=selectTableWhere("SubProceso","idProcedimiento","'".$_POST['procedimiento']."'");
                while ($fila2=mysql_fetch_array($result2)){
                    echo "<input type='text' id='procedi' class='textinput-12' value='".$fila2['descripcion']."' readonly>";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="maquina" class="formlabelscel col-xs-12">Maquina:</label>
            </div>
            <div class="col-xs-12">
                <input type="hidden" name="maquina" value="<?php if(isset($_POST['maquina'])){echo $_POST['maquina'];}else{echo 'MAQUINA9';}?>" readonly>
                <?php
                if(isset($_POST['maquina'])){
                    $result2=selectTableWhere("Maquina","idMaquina","'".$_POST['maquina']."'");
                    while ($fila2=mysql_fetch_array($result2)){
                        echo "<input type='text' id='maquina' class='textinput-12' value='".$fila2['descripcion']."' readonly>";
                    }
                }else{
                    echo "<input type='text' id='maquina' class='textinput-12' value='Manual - Propio' readonly>";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for='componentes' class="formlabelscel col-xs-12">Componente:</label>
            </div>
            <div class="col-xs-12">
                <input type="hidden" name='componente' value="<?php echo $_POST['componente'];?>" readonly>
                <?php
                $result=selectTableWhere("ProductoComponentesPrenda","idComponenteEspecifico","'".$_POST['componente']."'");
                while ($fila=mysql_fetch_array($result)){
                    $result1=selectTableWhere("ComponentesPrenda","idComponente","'".$fila['idComponente']."'");
                    while ($fila1=mysql_fetch_array($result1)){
                        echo "<input type='text' id='componentes' class='textinput-12' value='".$fila1['descripcion']."' readonly>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="cant" class="formlabelscel col-xs-12">Cantidad Terminada:</label>
            </div>
            <div class="col-xs-12">
                <input id="cant" type="text" name="cantidad" class="textinput-12" value="<?php echo $_POST['cantidad'];?>" readonly>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="btn btn-success col-xs-10 col-xs-offset-1" type="submit" name="guardar" value="Guardar">
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