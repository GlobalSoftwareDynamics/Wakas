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
        <title>Portal Operativo</title>
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
                <a class="navbar-brand" href="mainOperario.php">W<span>&alpha;</span>k<span>&alpha;</span>-s</a>
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
$nombre =$_SESSION['nombre'];
$result="SELECT * FROM empleado WHERE nombres ='".$nombre."'";
$result1=mysql_query($result);
while ($fila=mysql_fetch_array($result1)){
    $idempleado=$fila['idEmpleado'];
}
$bandera=false;
$bandera2=false;
date_default_timezone_set('America/Lima');
if(isset($_POST['regingreso'])){
    $hora = date('H:i:s');
    $fecha = date('m/d/Y');
    $aux = 0;
    $result = selectTable("RegistroIngresoSalida");
    while($fila = mysql_fetch_array($result)){
        $aux++;
    }
    $aux++;
    $insertar = mysql_query("INSERT INTO registroingresosalida (idRegistroIngresoSalida, idEmpleado, horaIngreso, horaSalida, fecha, estado) VALUES
                        ('".$aux."','".$idempleado."','".$hora."','-','".$fecha."','1')");
    $bandera = true;
    $bandera2 = false;
}
if(isset($_POST['regsalida'])){
    $hora = date('H:i:s');
    $aux = 0;
    $result = selectTableWhere2("RegistroIngresoSalida","idEmpleado","'".$idempleado."'","estado","1");
    while($fila = mysql_fetch_array($result)){
        $idRegistroNum = $fila['idRegistroIngresoSalida'];
    }
    $actualizar = mysql_query("UPDATE registroingresosalida SET horaSalida = '".$hora."' WHERE idRegistroIngresoSalida = '".$idRegistroNum."' AND idEmpleado = '".$idempleado."'");
    $actualizar = mysql_query("UPDATE registroingresosalida SET estado = '0' WHERE idRegistroIngresoSalida = '".$idRegistroNum."' AND idEmpleado = '".$idempleado."'");
    
    $bandera = false;
    $bandera2 = true;
}
if(($bandera)&&($bandera2)){
	$bandera = false;
	$bandera2 = false;
}
?>
<section class="container">
    <div class="col-xs-12">
        <h3 class="h3operario">¿Qué desea Hacer?</h3>
    </div>
</section>
<br>
<section>
    <form method="post" class="form-horizontal jumbotron col-xs-12">
        <button class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" formaction="#" name="regingreso">Registrar Ingreso</button><br/><br>
        <button class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" formaction="#" name="regsalida">Registrar Salida</button><br/><br><hr>
        <button class="btn btn-default col-xs-10 col-xs-offset-1" type="submit" formaction="mainOperario.php" name="volver">Volver al menú inicial</button>
    </form>
    <?php 
    if($bandera) {
    				echo "<br/>";
                    echo "<div class='alert alert-info' role='alert'>";
                    echo 	"<p> <strong>Su ingreso ha sido registrado correctamente</strong></p>";
                    echo " </div>";
                }
    if($bandera2) {
    				echo "<br/>";
                    echo "<div class='alert alert-info' role='alert'>";
                    echo 	"<p> <strong>Su salida ha sido registrada correctamente</strong></p>";
                    echo " </div>";
                }  
    ?>
</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 		<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    echo "Alguien esta tratando de entrar a nuestro sitio Web. Un log ha sido creado automaticamente para despedirte. Gracias por visitar Waka-s SGI :)";
}
?>