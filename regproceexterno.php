<!DOCTYPE html>
<?php
session_start();
require('funciones.php');
conexion();

if(isset($_SESSION['login'])){
mysql_query("SET NAMES 'utf8'");
$nombre =$_SESSION['nombre'];
$result="SELECT * FROM empleado WHERE nombres ='".$nombre."'";
$result1=mysql_query($result);
while ($fila=mysql_fetch_array($result1)){
    $idempleado=$fila['idEmpleado'];
}
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <script>
        function getproduct(val) {
            $.ajax({
                type: "POST",
                url: "get_productext.php",
                data:'idlote='+val,
                success: function(data){
                    $("#product").html(data);
                }
            });
        }
        function getprocedimext() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('product').value;
            $.ajax({
                type: "POST",
                url: "get_proceext.php",
                data:'lote=' + lote + '&producto=' + producto,
                success: function(data){
                    $("#procedi").html(data);
                }
            });
        }
        function getcomponentes() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('idproduct').value;
            var procedimiento = document.getElementById('procedi').value;
            $.ajax({
                type: "POST",
                url: "get_compsext.php",
                data:'lote=' + lote + '&producto=' + producto + '&procedimiento=' + procedimiento,
                success: function(data){
                    $("#componentes").html(data);
                }
            });
        }
        function getcantidadlote() {
            var lote = document.getElementById('lot').value;
            var producto = document.getElementById('idproduct').value;
            var procedimiento = document.getElementById('procedi').value;
            var componente = document.getElementById('componentes').value;
            $.ajax({
                type: "POST",
                url: "get_cantlote1.php",
                data:'lote=' + lote + '&producto=' + producto + '&procedimiento=' + procedimiento+ '&componente=' + componente,
                success: function(data){
                    $("#canti").html(data);
                }
            });
        }
    </script>

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
                <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60" width="auto"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                            <li><a href="gestionOP.php">Visualizaci&oacuten de Ordenes de Producci&oacuten</a></li>
                            <li><a href="gestionProductos.php">Visualizaci&oacuten de Productos</a></li>
                            <li><a href="rendimiento.php">Visualizaci&oacuten de Rendimiento</a></li>
                            <li><a href="menuestadoproceso.php">Visualizaci&oacuten de Estado de Proceso</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPERACIONES<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="nuevaCV.php">Nueva Confirmaci&oacuten de Venta</a></li>
                            <li><a href="OpcionHE.php">Nueva Hoja de Especificaciones</a></li>
                            <li><a href="OPnueva.php">Nueva Orden de Producción</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INFORMACIÓN INTERNA<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionMateriales.php">Materiales</a></li>
                            <li><a href="gestionMaquinas.php">M&aacutequinas</a></li>
                            <li><a href="gestionInsumos.php">Insumos</a></li>
                            <li><a href="gestionOperarios.php">Empleados</a></li>
                            <li><a href="gestionProcesos.php">Procesos</a></li>
                            <li><a href="gestionRepuestos.php">Repuestos</a></li>
                            <li><a href="menuagregarotros.php">Otros</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTACTOS<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionClientes.php">Clientes</a></li>
                            <li><a href="gestionProveedores.php">Proveedores</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</header>
<?php
if(isset($_POST['guardar'])){
    date_default_timezone_set('America/Lima');
    $fecha=date("m/d/Y");
    $aux=0;
    $result=selectTable('EmpleadoLote');
    while ($fila=mysql_fetch_array($result)){
        $aux++;
    }
    $aux++;
    $lote=strtoupper($_POST['idlote']);
    $proceso="INSERT INTO EmpleadoLote(idRegistro,idLote, idEmpleado, idProducto, idProcedimiento, idComponenteEspecifico, cantidad, fecha) VALUES ('".$aux."','".$lote."','".$_POST['idempleado']."','".$_POST['producto']."','".$_POST['procedimiento']."','".$_POST['componente']."','".$_POST['cantidad']."','".$fecha."')";
    $insert=mysql_query($proceso);
    if ( !empty( $error = mysql_error() ) ) {
    echo 'Mysql error '. $error ."<br/>\n";
    }else{
        echo "<br>
                    <div class='container col-sm-12'>
                        <div class='alert alert-success' role='alert'>
                            <p><strong>Registro Exitoso</strong></p>
                        </div>
                    </div>
                ";
    }
}
?>
<section class="container">
    <form action="regproceexterno.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
        <div>
            <h3>Ingreso de Proceso Tercerizado</h3>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="dni" class="formlabels col-xs-12">DNI:</label>
            </div>
            <div class="col-sm-7">
                <input class="textinput-5" id="dni" type="text" name="idempleado" value="<?php echo $idempleado;?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="lot" class="formlabels col-xs-12">Indique el idLote:</label>
            </div>
            <div class="col-sm-7">
                <input class="textinput-5" id="lot" type="text" name="idlote" oninput="getproduct(this.value);getprocedimext()">
            </div>
        </div>
        <div class="form-group" id="product">

        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="procedi" class="formlabels col-xs-12">Procedimiento:</label>
            </div>
            <div class="col-sm-7">
                <select id="procedi" name="procedimiento" class="ddselect-10" onChange='getcomponentes();'>
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for='componentes' class="formlabels col-xs-12">Seleccione Componente o Parte:</label>
            </div>
            <div class="col-sm-7">
                <select id='componentes' class="ddselect-8" name='componente' onChange='getcantidadlote();'>
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <label for="cant" class="formlabels col-xs-12">Cantidad Terminada:</label>
            </div>
            <div class="col-sm-7" id="canti">
                <input id="cant" type="text" name="cantidad" class="textinput-5">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input class="btn btn-success col-sm-6 col-sm-offset-3" type="submit" name="guardar" value="Registrar">
            </div>
        </div>
    </form>
</section>
<script src="js/bootstrap.min.js"></script>
<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
</body>
</html>
<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifiquese.";
}
?>