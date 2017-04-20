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
    <title>Registar datos</title>
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
                <a class="navbar-brand" href="mainOperario.php">W<span>&alpha;</span>k<span>&alpha;</span>-s Textiles</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="mainOperario.php">Inicio</a></li>
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
                <label for="producto" class="formlabelscel col-xs-12">Producto:</label>
            </div>
            <div class="col-xs-12">
                <input type="text" class="textinput-12" name="producto" value="<?php echo $_POST['producto'];?>" readonly>
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
                <label for="cant" class="formlabelscel col-xs-12">Cantidad Terminada:</label>
            </div>
            <div class="col-xs-12">
                <input id="cant" type="text" name="cantidad" class="textinput-12" value="<?php echo $_POST['cantidad'];?>" readonly>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" name="guardar" value="Guardar">
            </div>
        </div>
    </form>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>