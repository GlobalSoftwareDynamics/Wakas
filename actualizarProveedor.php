<!doctype html>
<?php
require('funciones.php');
session_start();
conexion();
if(isset($_SESSION['login'])){
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
        <form action="gestionProveedores.php" method="post" class="form-horizontal jumbotron col-sm-8 col-sm-offset-2">
            <div>
                <h3>Actualizar Proveedor</h3>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-5">
                    <label for="idProv" class="formlabels col-sm-12">idProveedor</label>
                </div>
                <div class="col-sm-7">
                    <?php
                    $result=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila=mysql_fetch_array($result)){
                        echo "
                            <input class='textinput-5' type='text' name='idProv' id='idProv' value='".$_GET['idProveedor']."' readonly>
                        ";
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-5">
                    <label for="nombre" class="formlabels col-sm-12">Nombre</label>
                </div>
                <div class="col-sm-7">
                    <?php
                    $result1=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila1=mysql_fetch_array($result1)){
                        echo "
                                <input class='textinput-8' type='text' name='nombre' id='nombre' value='".$fila1['nombre']."'>
                            ";
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-5">
                    <label for="direccion" class="formlabels col-sm-12">Direcci&oacute;n</label>
                </div>
                <div class="col-sm-7">
                    <?php
                    $result2=selectTableWhere('Proveedor','idProveedor',"'".$_GET['idProveedor']."'");
                    while ($fila2=mysql_fetch_array($result2)){
                        echo "
                                <input class='textinput-10' type='text' name='direccion' id='direccion' value='".$fila2['Direccion']."'>
                            ";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input class='btn btn-default col-sm-6 col-sm-offset-3' type="submit" name="regresar" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input class='btn btn-success col-sm-6 col-sm-offset-3' type="submit" name="actualizar" value="Guardar Cambios">
                    </div>
                </div>
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
