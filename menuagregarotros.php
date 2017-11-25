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
    <title>Waka-s Textiles Finos S.A.</title>
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
    <form class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otroscolor.php">Agregar Color</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosunidadmedida.php">Agregar Unidad de Medida</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosincoterm.php">Agregar Incoterm</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosmetodopago.php">Agregar Metodo de Pago</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrospais.php">Agregar Pais</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosciudad.php">Agregar Ciudad</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosvia.php">Agregar Via de Envío</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrostipoproducto.php">Agregar Tipo de Producto</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otroscomponente.php">Agregar Componente</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosmedida.php">Agregar Medidas</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosactividadmuerta.php">Agregar Actividad Muerta</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrosgenero.php">Agregar Género</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrostalla.php">Agregar Talla</button>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="otrostipotalla.php">Agregar Códificacion de Talla</button>
        </div>
    </form>
</section>

<section class="container">
    <form class="form-horizontal jumbotron col-sm-6 col-sm-offset-3" method="post" action="#">
        <div class="col-sm-12">
            <button class="btn btn-success col-sm-12 boton" type="submit" formaction="recovery.php">Centro de Recuperación de Datos</button>
        </div>
    </form>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
