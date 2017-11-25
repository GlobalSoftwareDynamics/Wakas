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
    <title>Nueva Orden de Producción</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="css/Formularios.css" rel="stylesheet">
    <link href="css/Tablas.css" rel="stylesheet">
    <script>

        $(function() {
            $( "#datepicker" ).datepicker();
        });

        function getcv(val) {
            $.ajax({
                type: "POST",
                url: "get_cv.php",
                data:'fecha='+val,
                success: function(data){
                    $("#cont").html(data);
                }
            });
        }

        function getproducto(val) {
            $.ajax({
                type: "POST",
                url: "get_producto.php",
                data:{'contrato':val},
                success: function(data){
                    $("#prod").html(data);
                }
            });
        }
        function getcolor() {
            var contrato = document.getElementById('cont').value;
            var producto = document.getElementById('prod').value;
            $.ajax({
                type: "POST",
                url: "get_color.php",
                data:'contrato=' + contrato + '&producto=' + producto,
                success: function(data){
                    $("#col").html(data);
                }
            });
        }
        function gettallas() {
            var contrato = document.getElementById('cont').value;
            var producto = document.getElementById('prod').value;
            var color = document.getElementById('col').value;
            $.ajax({
                type: "POST",
                url: "get_tallas.php",
                data:{'contrato':contrato, 'producto':producto, 'color':color},
                success: function(data){
                    $("#tablatallas").html(data);
                }
            });
        }
        /*function getcantidad() {
            var contrato = document.getElementById('cont').value;
            var producto = document.getElementById('prod').value;
            var color = document.getElementById('col').value;
            var talla = document.getElementById('tall').value;
            $.ajax({
                type: "POST",
                url: "get_cantidad.php",
                data:{'contrato':contrato, 'producto':producto, 'color':color, 'talla':talla},
                success: function(data){
                    $("#cant").html(data);
                }
            });
        }*/
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
                <a href="mainAdmin.php"><img src="image/LogoWakas.png" height="60"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="gestionCV.php">Visualizaci&oacuten de Confirmaciones de Venta</a></li>
                            <li><a href="gestionOP.php">Visualizaci&oacuten de Órdenes de Producci&oacuten</a></li>
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

<section class="container">
    <form class="form-horizontal jumbotron col-sm-8 col-sm-offset-2" action="nuevaOP.php" method="post">
        <div>
            <h4>Nueva Órden de Producción</h4>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="datepicker" class="formlabels col-sm-12">Fecha:</label>
                </div>
                <div class="col-sm-7">
                    <input name="fecha" class="textinput-4" id="datepicker" onchange='getcv(this.value);'>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="cont" class="formlabels col-sm-12">Confirmación de Venta:</label>
                </div>
                <div class="col-sm-7">
                    <select name="contrato" class="ddselect-8" id="cont" onchange='getproducto(this.value);'>
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="prod" class="formlabels col-sm-12">Producto:</label>
                </div>
                <div class="col-sm-7">
                    <select name="producto" class="ddselect-8" id="prod" onchange="getcolor();">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <label for="col" class="formlabels col-sm-12">Color:</label>
                </div>
                <div class="col-sm-7">
                    <select name="color" class="ddselect-6" id="col" onchange="gettallas();">
                        <option>Selecc.</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group" id="tablatallas">
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-success col-sm-6 col-sm-offset-3" name="ordenprodform" value="Crear Orden">
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
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>